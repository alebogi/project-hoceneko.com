<?php
/**
 * @author Aleksandra Bogicevic 0390/17
 * @coauthor Ognjen Subaric 0425/17
 */
?>

<!-- pocetak glavnog dela -->
<div class="row centar">

<!-- pocetak dela kategorija -->
<div class="col-sm-3 col-md-3 col-lg-3 kategorije">
    <div class="row kat justify-content-center">
        Kategorije
    </div>
    <div class="row text-left">
        <ul>
            <li>
                <?=anchor("$controller/mojaPretraga/sve", 'Sve objave', array('class' => 'a-link'));?>
            </li>
            <!--<li>-->
            <li>
                <?=anchor("$controller/mojaPretraga/Sport", 'Sport', array('class' => 'a-link'));?>
            </li>
            <ul>
                <li><?=anchor("$controller/mojaPretraga/Kosarka", 'Kosarka', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Fudbal", 'Fudbal', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Odbojka", 'Odbojka', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Rukomet", 'Rukomet', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Tenis", 'Tenis', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Stoni tenis", 'Stoni tenis', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Stoni fudbal", 'Stoni fudbal', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Ragbi", 'Ragbi', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Pecanje", 'Pecanje', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Sah", 'Sah', array('class' => 'a-link'));?></li>
            </ul>
            <!--</li>-->
            <!--<li>-->
            <li><?=anchor("$controller/mojaPretraga/Ples", 'Ples', array('class' => 'a-link'));?></li>
            <!--</li>-->
            <!--<li>-->
            <li><?=anchor("$controller/mojaPretraga/Kultura", 'Kultura', array('class' => 'a-link'));?></li>
            <ul>
                <li><?=anchor("$controller/mojaPretraga/Bioskop", 'Bioskop', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Pozoriste", 'Pozoriste', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Opera", 'Opera', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Balet", 'Balet', array('class' => 'a-link'));?></li>
            </ul>
            <!--</li>-->
            <!--<li>-->
            <li><?=anchor("$controller/mojaPretraga/Koncerti", 'Koncerti', array('class' => 'a-link'));?></li>
            <!--</li>-->
            <li><?=anchor("$controller/mojaPretraga/Gejming", 'Gejming', array('class' => 'a-link'));?></li>
            <!--<li>-->
            <li><?=anchor("$controller/mojaPretraga/Izlasci", 'Izlasci', array('class' => 'a-link'));?></li>
            <ul>
                <li><?=anchor("$controller/mojaPretraga/Kafane", 'Kafane', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Splavovi", 'Splavovi', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Klubovi", 'Klubovi', array('class' => 'a-link'));?></li>
                <li><?=anchor("$controller/mojaPretraga/Rejv", 'Rejv', array('class' => 'a-link'));?></li>
            </ul>
			 <li> <?= anchor("$controller/filteri", 'Filteri', array('class'=>'a-link'));?> </li>
            <!--</li>-->
        </ul>
    </div>
    
</div>
<!-- kraj dela kategorija -->