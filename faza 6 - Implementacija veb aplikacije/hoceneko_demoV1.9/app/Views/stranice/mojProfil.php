<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
     */

?>

<?php
use App\Models\KorisnikModel;
?>

<!-- main deo gde se ubacuju stranice -->
<div class="col-sm-8 col-md-8 col-lg-8 main">
                
                <!-- pregled profila-->
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="row ">
                            <?php 
                                $korisnikModel = new KorisnikModel();
                                $korisnikIzBaze = $korisnikModel->find($korisnik->idKor);
                                
                                if (empty($korisnikIzBaze->profilna_slika)){
                                    $filepath="/uploads/glava.jpg"; 
                                }else{
                                   $filepath="/uploads/"."$korisnik->korisnicko_ime"."_profilna.jpg";
                                }
                            ?>
                            <img src="<?php echo $filepath; ?>" id="profilnaSlika"> 
                        </div>
                       <div class="row justify-content-center dodSlike">
                        <?php 
                            echo form_open_multipart("$controller/promenaSlike","method=post");
                            echo "Izaberi sliku:<br>";
                            echo "<input type='file' name='profilna_slika' />";
                        ?>
                            <button type="submit" class="btn">Promeni sliku</button>
                            <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br><br>"; ?>
                        <?php 
                            echo form_close();
                        ?>
                       </div>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8 justify-content-left profilAbout">
                        Korisnicko ime:&nbsp;&nbsp;
                        <span id="profilKorIme">
                            <?php
                                echo "{$korisnik->korisnicko_ime}";
                            ?>
                        </span>
                        <br/>
                        Ime:&nbsp;&nbsp;
                        <span id="profilIme">
                            <?php
                                echo "{$korisnik->ime}";
                            ?>
                        </span>
                        <br/>
                        Prezime:&nbsp;&nbsp;
                        <span id="profilPrezime">
                            <?php
                                echo "{$korisnik->prezime}";
                            ?>
                        </span>
                        <br/>
                        Pol:&nbsp;&nbsp;
                        <span id="profilPol">
                            <?php
                                echo "{$korisnik->pol}";
                            ?>
                        </span>
                        <br/>
                        Datum rodjenja:&nbsp;&nbsp;
                        <span id="profildatrodj">
                            <?php
                                echo "{$korisnik->datum_rodjenja}";
                            ?>
                        </span>
                        <br/>
                        E-mail:&nbsp;&nbsp;
                        <span id="profilEmail">
                            <?php
                                echo "{$korisnik->e_mail}";
                            ?>
                        </span>
                        <br/>
                        Opis: <br/>
                        <span id="profilOpis">
                            <?php
                                echo "{$korisnik->opis}";
                            ?>
                        </span>
                        <?php 
                           // echo form_open("Korisnik/promenaOpisa","method=post");
                           // echo "Promeni opis:<br>";
                           // echo form_textarea("opis",set_value("{$korisnik->opis}"), ['maxlength'=> 250]);
                           // echo("<br>");
                        ?>
                        <!-- <button type="submit" class="btn">Promeni opis</button> -->
                         <?php 
                          //  echo form_close();
                        ?>
                    </div>
                </div>
                <div class="row profilOceneWrapper justify-content-center">
                    Moja ocena:&nbsp;&nbsp;
                    <span id="profilOCena">
                        <?php
                                echo "{$korisnik->ocena}";
                          ?>
                    </span>
                </div>
                <!-- kraj pregleda profila-->

                 
            </div>
            <!-- kraj main dela koji ce se ubacivati - "stranice" -->