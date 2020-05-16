<?php
/**
 * @author Ognjen Subaric 0425/17
 * @coauthor Aleksandra Bogicevic 0390/17
 */
?>

<div class="col-sm-8 col-md-8 col-lg-8 main">

<form name="opcijeSortiranja" action="<?= site_url("$controller/sortiranje") ?>" method="GET">
    Sortiraj po:
    <select name="tipSortiranja">
        <option value="datum ASC">datumu(rastuce)</option>
        <option value="datum DESC">datumu(opadajuce)</option>
        <option value="ocena ASC">oceni(rastuce)</option>
        <option value="ocena DESC">oceni(opadajuce)</option>
        <option value="br_potrebnih_clanova ASC">broju trazenih ljudi(rastuce)</option>
        <option value="br_potrebnih_clanova DESC">broju trazenih ljudi(opadajuce)</option>
    </select>
    <button type="submit" name="sortiraj" value="sortiraj">Sortiraj</button>

</form>
<br>
<br>

<?php   
use App\Models\KorisnikModel;

if(isset($poruka)) {
    echo $poruka[0] . $poruka[1] . "<br><br><br>";
}
else{
    echo "Sortirano po datumu, rastuce <br><br><br>";
}
?>



<?php
foreach ($objave as $objava) {
  //  $korisnikModel = new KorisnikModel();
    $organizatorKorIme = $korIme[$objava->idKor];
    $korisnikModel = new KorisnikModel(); 
    $organizatorId = $korisnikModel->dohvatiId($organizatorKorIme);
    
    
    echo "<b>{$objava->naziv}</b><br>"
      . "Organizator: " . anchor("$controller/profil/$organizatorId",  $korIme[$objava->idKor])  . "<br>"
   /* . "Broj potrebnih clanova: " . "{$objava->br_potrebnih_clanova}<br>"
    . "Broj prijavljenih clanova: " . "{$objava->br_prijavljenih_clanova}<br>"
    . "Datum odrzavanja: " . "{$objava->datum}<br>"
    . "Vreme odrzavanja: " . "{$objava->vreme}<br>"
    . "Mesto odrzavanja: " . "{$objava->mesto}<br>"*/
     . "Datum odrzavanja: " . "{$objava->datum}<br>"
    . "Broj potrebnih clanova: " . "{$objava->br_potrebnih_clanova}"
    . " &nbsp; &nbsp; &nbsp; Broj prijavljenih clanova: " . "{$objava->br_prijavljenih_clanova}<br><br>" 
    . "{$objava->opis}<br>" 
    .anchor("$controller/objava/{$objava->idObj}", "...detaljnije"). "<br><hr><br>";
     
    
    // . anchor("ovoPostaviDaVodiKaObjaviView", "Detaljnije") . "<br><br>";
    
}
?>

</div>