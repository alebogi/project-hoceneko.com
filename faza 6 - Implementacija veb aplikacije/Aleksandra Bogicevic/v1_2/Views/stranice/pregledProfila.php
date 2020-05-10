<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
     */

?>

<?php
use App\Models\KorisnikModel;
?>

<!-- main deo gde se ubacuju stranice -->
<div class="col-sm-7 col-md-7 col-lg-7 main">
                
                <!-- pregled profila-->
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="row ">
                            <?php 
                                $korisnikModel = new KorisnikModel();
                                $korisnikIzBaze = $korisnikModel->find($drugiKorisnik->idKor);
                                
                                if (empty($korisnikIzBaze->profilna_slika)){
                                    $filepath="/uploads/glava.jpg"; 
                                }else{
                                   $filepath="/uploads/"."$drugiKorisnik->korisnicko_ime"."_profilna.jpg";
                                }
                            ?>
                            <img src="<?php echo $filepath; ?>" id="profilnaSlika"> 
                        </div>
                       <div class="row justify-content-center">
                            <!-- ovo ima samo na strani moj profil -->
                            <!-- <button type="button" class="btn">Promeni sliku</button> -->
                       </div>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8 justify-content-left profilAbout">
                        Korisnicko ime:&nbsp;&nbsp;
                        <span id="profilKorIme">
                            <?php
                                echo "{$drugiKorisnik->korisnicko_ime}";
                            ?>
                        </span>
                        <br/>
                        Ime:&nbsp;&nbsp;
                        <span id="profilIme">
                            <?php
                                echo "{$drugiKorisnik->ime}";
                            ?>
                        </span>
                        <br/>
                        Prezime:&nbsp;&nbsp;
                        <span id="profilPrezime">
                            <?php
                                echo "{$drugiKorisnik->prezime}";
                            ?>
                        </span>
                        <br/>
                        Pol:&nbsp;&nbsp;
                        <span id="profilPol">
                            <?php
                                echo "{$drugiKorisnik->pol}";
                            ?>
                        </span>
                        <br/>
                        Datum rodjenja:&nbsp;&nbsp;
                        <span id="profildatrodj">
                            <?php
                                echo "{$drugiKorisnik->datum_rodjenja}";
                            ?>
                        </span>
                        <br/>
                        E-mail:&nbsp;&nbsp;
                        <span id="profilEmail">
                            <?php
                                echo "{$drugiKorisnik->e_mail}";
                            ?>
                        </span>
                        <br/>
                        Opis: <br/>
                        <span id="profilOpis">
                            <?php
                                echo "{$drugiKorisnik->opis}";
                            ?>
                        </span>

                    </div>
                </div>
                <div class="row profilOceneWrapper justify-content-center">
                    Moja ocena:&nbsp;&nbsp;
                    <span id="profilOCena">
                        <?php
                                echo "{$drugiKorisnik->ocena}";
                          ?>
                    </span>
                </div>
                <div class="row likeWrapper">
                    <?php
                        $session = session();
                        if(!empty($session->get('korisnik'))){
                                 echo '<span>Oceni me:</span> &nbsp;'; 
                        }
                    ?>
                     <?php 
                        $session = session();
                        if(!empty($session->get('korisnik'))){
                            echo  anchor("Korisnik/ocenaPozitivna", "Pozitivno",'class="btn btn-sm btn-light"');
                         } 
                      ?> 
                   &nbsp;&nbsp;&nbsp;
                      <?php 
                             $session = session();
                              if(!empty($session->get('korisnik'))){
                                  echo anchor("Korisnik/ocenaNegativna", "Negativno",'class="btn btn-sm btn-light"');
                               } 
                        ?> 
                    &nbsp;
                    <?php  
                        $session = session();
                         if(!empty($session->get('korisnik'))){
                            // echo "</div> ";
                 }
                 ?>
                </div>
                <!-- kraj pregleda profila-->

                 
            </div>
            <!-- kraj main dela koji ce se ubacivati - "stranice" -->