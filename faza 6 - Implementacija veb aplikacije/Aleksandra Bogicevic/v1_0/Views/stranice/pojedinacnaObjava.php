<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
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
                        </div>
                        <div class="row txtareawrapper">
                            <br/>
                            <br/>
                            <textarea id="dodajKom" placeholder="Dodaj komentar..." rows="5" cols="40"></textarea>
                        </div>
                        <div class="row">
                            <button type="button" class="btn" id="dodajKom">Komentarisi</button>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="row organizatorWrapper">
                            <img src="../img/glava.jpg" name="organizatorSlika" id="organizatorSlika"> <br/>
                            <p name="imeOrganizatora">
                            <?php
                                $korisnikModel = new KorisnikModel();
                                $korisnik = $korisnikModel->find($objava->idKor);
                                echo "{$korisnik->ime} {$korisnik->prezime}";
                            ?>
                            </p>
                        </div>
                        <div class="row likeWrapper">
                            <span id="numOfLikes">0</span> &nbsp;
                            <button type="button" name="like" class="likebtn"> Like </button>
                            <button type="button" name="dislike" class="dislakebtn"> Dislike</button>
                            &nbsp;<span id="numOfLikes">0</span>
                        </div>
                        <div class="row dodajMeWrapper">
                            <button type="button" name="pridruziMeDogadjaju" class="btn"> Dodaj me!</button>
                        </div>
                    </div>
                </div>
                 <!-- kraj pojedinacna objava-->
            </div>
            <!-- kraj main dela koji ce se ubacivati - "stranice" -->