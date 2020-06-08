<?php
/**
 * @author Aleksandra Bogicevic 0390/17
 * @coauthor Ognjen Subaric 0425/17
 */
?>

<!-- pocetak glavnog dela -->
<div class="row centar">

<!-- pocetak dela kategorija -->
<div class="col-sm-2 col-md-2 col-lg-2 kategorije">
    <div class="row kat justify-content-center">
        Kategorije
    </div>
    <div class="row text-left">
        <ul onmousedown="storeActiveNav('pocetna')">
            <li>
                <?=anchor("$controller/pretraga/sve", 'Sve objave', array('class' => 'a-link'));?>
            </li>
            <!--<li>-->
            <li>
                <?=anchor("$controller/pretraga/Sport", 'Sport', array('class' => 'a-link'));?>
            </li>
            <ul>
                <li><?=anchor("$controller/pretraga/Kosarka", 'Kosarka', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Fudbal", 'Fudbal', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Odbojka", 'Odbojka', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Rukomet", 'Rukomet', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Tenis", 'Tenis', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Stoni tenis", 'Stoni tenis', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Stoni fudbal", 'Stoni fudbal', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Ragbi", 'Ragbi', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Pecanje", 'Pecanje', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Sah", 'Sah', array('class' => 'a-link'));?></li>
            </ul>
            <!--</li>-->
            <!--<li>-->
            <li><?=anchor("$controller/pretraga/Ples", 'Ples', array('class' => 'a-link'));?></li>
            <!--</li>-->
            <!--<li>-->
            <li><?=anchor("$controller/pretraga/Kultura", 'Kultura', array('class' => 'a-link'));?></li>
            <ul>
                <li><?=anchor("$controller/pretraga/Bioskop", 'Bioskop', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Pozoriste", 'Pozoriste', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Opera", 'Opera', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Balet", 'Balet', array('class' => 'a-link'));?></li>
            </ul>
            <!--</li>-->
            <!--<li>-->
            <li><?=anchor("$controller/pretraga/Koncerti", 'Koncerti', array('class' => 'a-link'));?></li>
            <!--</li>-->
            <li><?=anchor("$controller/pretraga/Gejming", 'Gejming', array('class' => 'a-link'));?></li>
            <!--<li>-->
            <li><?=anchor("$controller/pretraga/Izlasci", 'Izlasci', array('class' => 'a-link'));?></li>
            <ul>
                <li><?=anchor("$controller/pretraga/Kafane", 'Kafane', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Splavovi", 'Splavovi', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Klubovi", 'Klubovi', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/pretraga/Rejv", 'Rejv', array('class' => 'a-link'));?></li>
            </ul>
            <br/> <br/>
            <li> <?= anchor("$controller/filteri", 'Filteri', array('class'=>'a-link'));?> </li>
            <!--</li>-->
        </ul>
    </div>
    
</div>
<!-- kraj dela kategorija -->