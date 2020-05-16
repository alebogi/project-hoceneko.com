<?php
    /**
     * @author Aleksandar Matic
     */
?>

<!-- main deo gde se ubacuju stranice -->
 <div class="col-sm-8 col-md-8 col-lg-8 main">
     <div>
<?php 
       echo "<br><h3>Najpopularnije objave:</h3> <br/>";  
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
    
}
}
?>
</table>
     </div>
     <div>
         <?php 
         echo "<br/><br/><hr><h3>Najbojle ocenjeni korisnici:</h3><br/>";
         $korisnikModel = new KorisnikModel();
         $korisnici = $korisnikModel->orderBy('ocena','DESC')->findAll(3);
         ?>
         <table class="pocetnatable">
             <tr><th></th><th>Korinicko ime</th><th>Ocena</th>
            
                 <?php 
                 if(empty($korisnici)){
                   echo "<tr><td>Ne postoji ni jedna objava.</td></tr>";
                 }
                 else {
                     foreach($korisnici as $kor){
                        // echo "<tr><td></td><td>{$kor->korisnicko_ime}</td><td>".intval($kor->ocena)."</td></tr>";
                         echo "<tr><td></td><td>".anchor("$controller/profil/{$kor->idKor}", "$kor->korisnicko_ime")."</td>";
                         echo "<td>".intval($kor->ocena)."</td></tr>";
                     }
                 }
                 ?>
         </table>
     </div>
     <div>
         <?php 
         echo "<br/><br/><hr><h3>Najskoriji dogadjaji:</h3><br/>";
         use App\Models\ObjavaModel;
         $objavaModel2 = new ObjavaModel();
         $nove_objave = $objavaModel2->where('datum >=', date("Y-m-d"))->orderBy('datum','ASC')->findAll(3);
         ?>
         <table class="pocetnatable">
              <tr><th>Naziv</th><th>Objavio</th><th>Broj potrebnih clanova</th><th>Broj prijavljenih clanova</th><th>Detaljnije</th> 
                 <?php 
                 if(empty($korisnici)){
                   echo "<tr><td>Ne postoji ni jedan korisnik.</td></tr>";
                 }
                 else {
                     foreach($nove_objave as $obj){
                       $korisnikModel2 = new KorisnikModel();
                       $kor2= $korisnikModel2->find($obj->idKor);
                           echo "<tr><td>{$obj->naziv}</td>";
                           echo "<td>".anchor("$controller/profil/{$kor2->idKor}", "$kor2->korisnicko_ime")."</td>";
                           echo"<td>{$obj->br_potrebnih_clanova}</td><td>{$obj->br_prijavljenih_clanova}</td>";
                           echo "<td>".anchor("$controller/objava/{$obj->idObj}", "Link")."</td></tr>";
                     }
                 }
                 ?>
         </table>
     </div>
     
 </div>
<!-- kraj main dela koji ce se ubacivati - "stranice" -->
            