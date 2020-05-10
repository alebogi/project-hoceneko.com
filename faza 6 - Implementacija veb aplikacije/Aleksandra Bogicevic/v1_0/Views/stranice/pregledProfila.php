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
                            <img src="/img/glava.jpg" id="profilnaSlika"> <!-- DOHVATITI SLIKU IZ BAZE -->
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
				<div class="row likeWrapper">
                            <button type="button" name="like" class="likebtn"> Like </button>
                            <button type="button" name="dislike" class="dislakebtn"> Dislike</button>
                 </div>
                <!-- kraj pregleda profila-->

                 
            </div>
            <!-- kraj main dela koji ce se ubacivati - "stranice" -->