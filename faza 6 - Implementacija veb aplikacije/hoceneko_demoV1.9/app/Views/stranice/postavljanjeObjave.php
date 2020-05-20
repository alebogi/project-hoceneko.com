<?php
/**
 * @author Aleksandar Matic
 * @coauthor Aleksandra Bogicevic 0390/17
 */
?>


<!-- main deo gde se ubacuju stranice -->
 <div class="col-sm-8 col-md-8 col-lg-8 main ">
     <div clss="row">
         <?php
             if(!empty($errors)) echo "<span style='color:red'>$errors</span>";
         ?>
     </div>
     <div class="row justify-content-center">
         <?php
   

    echo form_open("$controller/postavljanjeObjave_potvrda","method=post");    
    echo "<br/>Naziv:<br/>";
    echo form_input("naziv",set_value("naziv")); 
    
    $options = [
        'Sport-Kosarka'  => 'Sport - Kosarka',
        'Sport-Fudbal'    => 'Sport - Fudbal',
        'Sport-Odbojka'  => 'Sport - Odbojka',
        'Sport-Rukomet' => 'Sport - Rukomet',
        'Sport-Tenis'  => 'Sport - Tenis',
        'Sport-Stoni_tenis'    => 'Sport - Stoni tenis',
        'Sport-Stoni_fudbal'  => 'Sport - Stoni fudbal',
        'Sport-Ragbi' => 'Sport - Ragbi',
        'Sport-Pecanje'  => 'Sport - Pecanje',
        'Sport-Sah'    => 'Sport - Sah',
        'Ples'  => 'Ples',
        'Kultura-Bioskop' => 'Kultura - Bioskop',
        'Kultura-Pozoriste'  => 'Kultura - Pozoriste',
        'Kultura-Opera'    => 'Kultura - Opera',
        'Kultura-Balet'  => 'Kultura - Balet',
        'Koncerti' => 'Koncerti',
        'Gejming'  => 'Gejming',
        'Izlasci-Kafane'    => 'Izlasci - Kafane',
        'Izlasci-Splavovi'  => 'Izlasci - Splavovi',
        'Izlasci-Klubovi' => 'Izlasci - Klubovi',
        'Izlasci-Rejv' => 'Izlasci - Rejv'
];
    echo "<br/>Kategorija:<br/>";
    echo form_multiselect("kategorija",$options, ['sport-kosarka']); 
    
    echo "<br/>Broj potrebnih clanova:<br/>";
    echo form_input("broj_potrebnih_clanova",set_value("broj_potrebnih_clanova"), $type="number"); 
    
    echo "<br/>Datum odrzavanja:<br/>";
    echo form_input("datum",set_value("datum"),'','date'); 
    
    echo "<br/>Vreme odrzavanja:<br/>";
    echo form_input("vreme",set_value("vreme"),'','time'); 
    
    echo "<br/>Mesto odrzavanja:<br/>";
    echo form_input("mesto",set_value("mesto")); 
    
    echo "<br>Opis:<br/>";
    echo form_textarea("opis",set_value("opis"), ['maxlength'=> 999]);
    
    echo "<br/>";
    echo form_checkbox('tip', 'tip', FALSE);
    echo "Da li zelite da boostujete ovu objavu?";
    
    echo "<br/><br/>";
     echo("<input class='btn' type='submit' value='Objavi'/>");
    //echo form_submit("objavi", "Objavi!");
    echo form_close();
?>
     </div>
 </div>