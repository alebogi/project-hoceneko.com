<?php
/**
 * @author Ognjen Subaric 0425/17
 * @coauthor Aleksandra Bogicevic 0390/17
 */
?>

<div class="col-sm-7 col-md-7 col-lg-7 main">

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

foreach ($objave as $objava) {
  //  $korisnikModel = new KorisnikModel();
    $organizatorKorIme = $korIme[$objava->idKor];
    $korisnikModel = new KorisnikModel(); 
    $organizatorId = $korisnikModel->dohvatiId($organizatorKorIme);
    
    
    echo "{$objava->naziv}<br>"
      . "Korisnicko ime:" . anchor("$controller/profil/$organizatorId",  $korIme[$objava->idKor])  . "<br>"
    . "Broj potrebnih clanova: " . "{$objava->br_potrebnih_clanova}<br>"
    . "Broj prijavljenih clanova: " . "{$objava->br_prijavljenih_clanova}<br>"
    . "Datum: " . "{$objava->datum}<br>"
    . "Vreme: " . "{$objava->vreme}<br>"
    . "Mesto: " . "{$objava->mesto}<br>"
    . anchor("$controller/objava/{$objava->idObj}", "Detaljnije"). "<br><br>";
    // . anchor("ovoPostaviDaVodiKaObjaviView", "Detaljnije") . "<br><br>";
    
}
?>

</div>