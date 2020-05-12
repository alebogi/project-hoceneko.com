<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
     * @coauthor Ognjen Subaric 0425/17
     */

?>

<?php
use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
?>

<!-- main deo gde se ubacuju stranice -->
<div class="col-sm-7 col-md-7 col-lg-7 main">
     <!-- pojedinacna objava-->
                <div class="row text-center justify-content-center">
                    <span id="nazivObjave">
                    <?php 
                        echo "{$objava->naziv}";
                    ?>
                    </span>
                </div>
                <div class="row text-center justify-content-center">
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <!-- namerno prazno-->
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8  text-center justify-content-center tekstObjaveWrapper">
                        <span id="tekstObjave">
                        <?php 
                            echo "{$objava->opis}";
                        ?>
                        </span>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <!-- namerno prazno-->
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
                    <div class="col-sm-8 col-md-8 col-lg-8">
                        <div class="row text-center justify-content-center">
                            <label for="sviKometari"><b>Komentari</b></label>
                        </div>
                         <div class="row komWrapper">
                            <p id="sviKometari">Izlistani komentari</p>
                            <br>
                            <ul>
                                <?php forEach($komentari as $komentar) {?>
                               
                                <?php 
                                $korisnikModel = new KorisnikModel();
                                $korisnik = $korisnikModel->find($komentar->idKor);
                                echo "<li>".$korisnik->korisnicko_ime." : ".$komentar->sadrzaj;
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
                            <div class="row txtareawrapper">
                                <br/>
                                <br/>
                                <textarea name="komentar" id="dodajKom" placeholder="Dodaj komentar..." rows="5" cols="40"></textarea>
                            </div>
                            <?php $rand=rand(); ?>
                            <?php $_SESSION['rand']=$rand; ?>
                            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                            <div class="row">
                                <button name="submitKom" value="submited" type="submit" class="btn" id="dodajKom">Komentarisi</button>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="row organizatorWrapper">
                            Organizator: <br/>
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
                            <br/>
                            <p name="imeOrganizatora">
                                <br/> <br/>
                            <?php
                               echo anchor("$controller/profil/{$organizator->idKor}", "$organizator->ime $organizator->prezime");
                            ?>
                            </p>
                        </div>
                       <!-- <div class="row likeWrapper">
                            <span id="numOfLikes">0</span> &nbsp;
                            <button type="button" name="like" class="likebtn"> Like </button>
                            <button type="button" name="dislike" class="dislakebtn"> Dislike</button>
                            &nbsp;<span id="numOfLikes">0</span>
                        </div> -->
                        <div class="row dodajMeWrapper">
                            <?php if($controller == "Korisnik" || $controller == "Admin") {?>
                        <form name="prijavaDogadjaj" action="<?= site_url("$controller/prijavaDogadjaj/{$objava->idObj}") ?>" method="GET">
                            <div class="row dodajMeWrapper">
                                <button type="submit" name="pridruziMeDogadjaju" class="btn"> Dodaj me!</button>
                                <?php if(isset($_SESSION['porukaGreska'])) echo $_SESSION['porukaGreska']; ?>
                                <?php unset($_SESSION['porukaGreska']); ?>
                            </div>
                        </form>
                        <?php 
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