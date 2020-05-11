<!-- main deo gde se ubacuju stranice -->
 <div class="col-sm-7 col-md-7 col-lg-7 main">
<?php 
     if($filtrirano == false)
        echo "<h3>Sve objave</h3>";
     else echo "<h3>Rezultati filtriranja:</h3>";
        
if(!empty($pager)) {
?>
<?= $pager->links() ?>
<?php }?>
<table>
    <tr><th>Naziv</th><th>Objavio</th><th>Broj potrebnih clanova</th><th>Broj prijavljenih clanova</th><th>Detaljnije</th> 
<?php
use App\Models\KorisnikModel;
if (empty($objave)){
echo "<tr><td>Ne postoji ni jedna objava.</td></tr>";
}
else {
foreach ($objave as $objava) {
    $korisnikModel = new KorisnikModel();
    $korisnik = $korisnikModel->find($objava->idKor);
    echo "<tr><td>{$objava->naziv}</td><td>{$korisnik->korisnicko_ime}</td><td>{$objava->br_potrebnih_clanova}</td><td>{$objava->br_prijavljenih_clanova}</td>";
    echo "<td>".anchor("$controller/objava/{$objava->idObj}", "Link")."</td></tr>";
}
}
?>
</table>
 </div>
<!-- kraj main dela koji ce se ubacivati - "stranice" -->
            