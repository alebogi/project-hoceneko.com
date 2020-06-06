<?php
    /**
     * @author Aleksandar Matic
     */
?>

<!-- main deo gde se ubacuju stranice -->
 <div class="col-sm-8 col-md-8 col-lg-8 main">
<?php 
       echo "<br/><h3>Prijave za objavu:</h3>";    
if(!empty($pager)) {
?>
<?= $pager->links() ?>
<?php }?>
<table class="pocetnatable">
    <tr><th>Naziv</th><th>Broj potrebnih clanova</th><th>Broj prijavljenih clanova</th><th>Korisnicko ime prijavljenog</th><th>Ocena prijavljenog</th>
<?php
use App\Models\KorisnikModel;
use App\Models\ObjavaModel;

 if(isset($_SESSION['porukaGreska'])) echo $_SESSION['porukaGreska'];
     unset($_SESSION['porukaGreska']); 
if (empty($prijave)){
echo "<tr><td>Ne postoji ni jedna prijava.</td></tr>";
}
else {
   
foreach ($prijave as $prijava) {
    $korisnikModel = new KorisnikModel();
    $korisnik = $korisnikModel->find($prijava->idKor);
    
    echo "<tr><td>{$objava->naziv}</td>";
    echo"<td>{$objava->br_potrebnih_clanova}</td><td>{$objava->br_prijavljenih_clanova}</td>";
    
    
    echo "<td>".anchor("$controller/profil/{$korisnik->idKor}", "$korisnik->korisnicko_ime")."</td>";
    
    
    echo "<td>{$korisnik->ocena}</td>"; 
    
    echo "<td>"; ?>
     <div class="col-sm-6 col-md-6 col-lg-6 colHdrBtnsAndName">
     <?= anchor("{$controller}/potvrdiPrijavu/{$prijava->idOPri}", "Potvrdi!",'class="btn btn-sm btn-info" style="background-color: green;margin-right: 2px;margin-left:2px;"') ?>
     </div>
    <?php
    echo "</td><td>"; ?>
    <div class="col-sm-6 col-md-6 col-lg-6 colHdrBtnsAndName">
     <?= anchor("{$controller}/odbaciPrijavu/{$prijava->idOPri}", "Odbaci!",'class="btn btn-sm btn-info" style="background-color: red;margin-right: 2px;margin-left:2px;"') ?>
     </div>
    <?php
    echo "</td></tr>";
    
    //echo "<td>{$korisnik->korisnicko_ime}</td>";
}
}
?>
</table>
 </div>
<!-- kraj main dela koji ce se ubacivati - "stranice" -->