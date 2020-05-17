<?php
    /**
     * @author Aleksandar Matic
     */
?>

<!-- main deo gde se ubacuju stranice -->
 <div class="col-sm-8 col-md-8 col-lg-8 main">
<?php 
       if($prikaz == 'filtrirano')
       echo "<br/><h3>Rezultati filtriranja:</h3>";  
       else echo "<h3>Moje objave:</h3>";  
if(!empty($pager)) {
?>
<?= $pager->links() ?>
<?php }?>
<table class="pocetnatable">
    <tr><th>Naziv</th><th>Organizator</th><th>Broj potrebnih clanova</th><th>Broj prijavljenih clanova</th><th>Detaljnije</th> 
<?php
use App\Models\KorisnikModel;
if (empty($objave)){
echo "<tr><td>Ne postoji ni jedna objava.</td></tr>";
}
else {
foreach ($objave as $objava) {
    $korisnikModel = new KorisnikModel();
    $korisnik = $korisnikModel->find($objava->idKor);
    echo "<tr><td>{$objava->naziv}</td>";
    
    
    
    echo "<td>".anchor("$controller/profil/{$korisnik->idKor}", "$korisnik->korisnicko_ime")."</td>";
    
    echo"<td>{$objava->br_potrebnih_clanova}</td><td>{$objava->br_prijavljenih_clanova}</td>";
    echo "<td>".anchor("$controller/objava/{$objava->idObj}", "Link")."</td></tr>";
    
    //echo "<td>{$korisnik->korisnicko_ime}</td>";
}
}
?>
</table>
 </div>
<!-- kraj main dela koji ce se ubacivati - "stranice" -->
            