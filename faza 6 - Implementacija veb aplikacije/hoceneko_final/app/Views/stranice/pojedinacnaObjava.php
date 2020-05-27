<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
     * @coauthor Ognjen Subaric 0425/17
     */

?>

<?php
use App\Models\ObjavaModel;
use App\Models\ObjavaPrijavaModel;
use App\Models\KorisnikModel;
?>

<!-- main deo gde se ubacuju stranice -->
<div class="col-sm-8 col-md-8 col-lg-8 main">
     <!-- pojedinacna objava-->
                <div class="row text-center justify-content-center">
                    <span id="nazivObjave">
                    <?php 
                        echo "{$objava->naziv}";
                    ?>
                    </span>
                </div>
                <div class="row text-center justify-content-center">
                    <div class="col-sm-3 col-md-3 col-lg-3">
                       <div class="row organizatorWrapper justify-content-center">
                            <br/> Organizator: <br/> <br/> 
                            <?php 
                                $korisnikModel = new KorisnikModel();
                                $organizator = $korisnikModel->find($objava->idKor);
                                if (empty($organizator->profilna_slika)){
                                    $filepath="/uploads/glava.jpg"; 
                                }else{
                                   $filepath="/uploads/"."$organizator->korisnicko_ime"."_profilna.jpg";
                                }
                            ?>
                            
                            <img src="<?php echo $filepath; ?>" id="organizatorSlika"> 
                            
                            <p name="imeOrganizatora">
                              
                            <?php
                               echo anchor("$controller/profil/{$organizator->idKor}", "$organizator->ime $organizator->prezime");
                              // echo "(Organizator)";
                            ?>
                            </p> 
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-7 col-lg-7  text-center justify-content-center tekstObjaveWrapper">
                        <div class="row justify-content-center" id="tekstObjave">
                           
                        <?php 
                            echo "{$objava->opis}";
                        ?>
                        
                        </div>
                        
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        
                    </div>
                </div>
                <div class="row infoWrapper">
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <b>Mesto: &nbsp;&nbsp;</b>
                        <span name="mesto">
                        <?php 
                            echo "{$objava->mesto}";
                        ?>
                        </span>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <b>Datum: &nbsp;&nbsp;</b>
                        <span name="datum">
                        <?php 
                            echo "{$objava->datum}";
                        ?>
                        </span>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <b>Vreme: &nbsp;&nbsp;</b>
                        <span name="vreme">
                        <?php 
                            echo "{$objava->vreme}";
                        ?>
                        </span>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <b>Popunjeno mesta: &nbsp;&nbsp;</b>
                        <span name="popunjeno">   
                        <?php 
                            echo "{$objava->br_prijavljenih_clanova}";
                        ?>
                        </span>/
                        <span name="slobodno">
                        <?php 
                            echo "{$objava->br_potrebnih_clanova}";
                        ?>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-8 ">
                        <br/> <br/>
                        <div class="row text-center justify-content-center wrapperKomenatarLabele">
                            <br/> <br/>
                            <label for="sviKometari"><b>Komentari:</b></label>
                        </div>
                        
                         <div class="row komWrapper justify-content-center">
                            
                            <ul>
                                
                                <?php
                                if(empty($komentari))
                                    echo "Ova objava jos uvek nema komentare.";
                                forEach($komentari as $komentar) {?>
                               
                                <?php 
                                $korisnikModel = new KorisnikModel();
                                $korisnik = $korisnikModel->find($komentar->idKor);
                                
                                
                                echo "<li>".anchor("$controller/profil/{$korisnik->idKor}", "$korisnik->korisnicko_ime")." : " . htmlspecialchars($komentar->sadrzaj);
                            
                                
                               // echo "<li>".$korisnik->korisnicko_ime." : ".$komentar->sadrzaj;
                                ?>
                                <?php 
                                   if($controller == 'Admin'){ ?>
                                    <div class="col-sm-6 col-md-6 col-lg-6 colHdrBtnsAndName">
                                  <?= anchor("Admin/ukloniKomentar/{$komentar->idKom}", "X",'class="btn btn-sm btn-info" style="background-color: red;"') ?>
                            </div>
                                
                                <?php  } echo"<br>";}?>
                            </ul>
                        </div>
                        <?php if($controller == "Korisnik" || $controller == "Admin") {?>
                        <form name="komentarisanje" action="<?= site_url("$controller/postaviKomentar/{$objava->idObj}") ?>" method="GET">
                            <div class="row txtareawrapper justify-content-center">
                                <br/>
                                <br/>
                                <textarea name="komentar" id="dodajKom" placeholder="Dodaj komentar..." rows="5" cols="40"></textarea>
                            </div>
                            <?php $rand=rand(); ?>
                            <?php $_SESSION['rand']=$rand; ?>
                            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                            <div class="row justify-content-center">
                                <button name="submitKom" value="submited" type="submit" class="btn btn-sm btn-info" id="dodajKom">Komentarisi</button>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <?php if($controller == "Korisnik" || $controller == "Admin") {
                                $prijavljen = false;
                                $db      = \Config\Database::connect();
                                $builder = $db->table('prijavljen');
                                $builder->select('*');
                                $builder->where('idKor', $_SESSION['korisnik']->idKor);
                                $builder->where('idObj', $objava->idObj);
                                if($builder->countAllResults() > 0) $prijavljen = true;
                                $objavaPrijavaModel = new ObjavaPrijavaModel();
                                if($objavaPrijavaModel->where('idObj',$objava->idObj)->where('idKor',$_SESSION['korisnik']->idKor)->countAllResults() > 0) $prijavljen = true;
                                if($prijavljen == false){
                                ?>
                        <div class="row dodajMeWrapper justify-content-center">   
                        <form name="prijavaDogadjaj" action="<?= site_url("$controller/prijavaDogadjaj/{$objava->idObj}") ?>" method="GET">
                            <div class="row dodajMeWrapper">
                                <button type="submit" name="pridruziMeDogadjaju" class="btn btn-sm btn-info"> Dodaj me!</button>
                                <?php if(isset($_SESSION['porukaGreska'])) echo $_SESSION['porukaGreska']; ?>
                                <?php unset($_SESSION['porukaGreska']); ?>
                            </div>
                        </form>
                        </div>
                        <div class="row justify-content-center">
                           <br/> <br/>   <br/> <br/>
                              <?php }
                                else { ?>
                        <div class="row dodajMe Wrapper justify-content-center">
                           <br/> <br/>   <br/> <br/>
                           <form name="odjavaDogadjaj" action="<?= site_url("$controller/odjavaDogadjaj/{$objava->idObj}") ?>" method="GET">
                            <div class="row dodajMeWrapper">
                                <button type="submit" name="odjaviMeSaDogadjaja" class="btn btn-sm btn-info" style="background-color: red;"> Odjavi me!</button>
                                <?php if(isset($_SESSION['porukaGreska'])) echo $_SESSION['porukaGreska']; ?>
                                <?php unset($_SESSION['porukaGreska']); ?>
                            </div>
                        </form>
                        </div>
                       <div class="row justify-content-center">
                           <br/> <br/>   <br/> <br/>
                           
                           <?php
                                }
                         if($controller == 'Admin'){ ?>
                            <div class="col-sm-6 col-md-6 col-lg-6 colHdrBtnsAndName">
                            <?= anchor("Admin/ukloniObjavu/{$objava->idObj}", "Ukloni objavu!",'class="btn btn-sm btn-info" style="background-color: red;"') ?>
                            </div>
                        <?php }
                                }?>
                       </div>
                    </div>
                </div>
                 <!-- kraj pojedinacna objava-->
            </div>
            <!-- kraj main dela koji ce se ubacivati - "stranice" -->