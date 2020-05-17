<?php
/**
 * 
 * @author Nikola Milicevic 0387/17
 * @coauthor Aleksandra Bogicevic 0390/17
 */
?>

<!-- main deo gde se ubacuju stranice -->
 <div class="col-sm-8 col-md-8 col-lg-8 main ">
      
        
     <div class="row registracija justify-content-center">
          
         <div class="col-sm-3 col-md-3 col-lg-3">
             <!-- namerno prazno -->
         </div>
         <div class="col-sm-3 col-md-3 col-lg-3">
             <?php
                echo form_open_multipart("Gost/registerSubmit","method=post");

                echo form_label('Korisnicko ime', 'korisnicko_ime');
             echo("<br>");
              echo form_label('Lozinka', 'lozinka');
              echo("<br>");
              echo form_label('Potvrdite lozinku', 'lozinka_p');
               echo("<br>");
               echo form_label('Ime', 'ime');

                   echo("<br>");
                   echo form_label('Prezime', 'prezime');

                   echo("<br>");
                   echo form_label('E-mail', 'e_mail');

                   echo("<br>");
                   echo form_label('Pol', 'pol');
                   echo("<br>");
                   echo form_label('Datum rodjenja', 'datum_rodjenja');

                   echo "<br>Opis:<br/>";
                   echo("<br>");
                    echo("<br>");
                     echo("<br>");
                      echo("<br>");
                       echo("<br>");
                       echo("<br>");
                      echo("<br>");
                       echo("<br>");
                       echo("<br>");
                    
                   echo "Profilna slika:<br>";

                   echo("<br>");

               
             ?>
         </div>
         <div class="col-sm-3 col-md-3 col-lg-3">
             <?php
              echo form_input(['name' => 'korisnicko_ime']);
             echo("<br>");
             echo form_password(['name' => 'lozinka']);
                   echo("<br>");
                   echo form_password(['name' => 'lozinka_p']);
                    echo("<br>");
                    
                   echo form_input(['name' => 'ime']);

                   echo("<br>");
                   echo form_input(['name' => 'prezime']);

                   echo("<br>");
                   echo form_input(['name' => 'e_mail']);

                   echo("<br>");
                   $options = [
                           'muski'  => 'muski',
                           'zenski'    => 'zenski',
                   ];

                   echo form_dropdown('pol',$options,'muski');
                   echo("<br>");
                   echo("<input type='date' name='datum_rodjenja'>");

                   echo form_textarea("opis",set_value("opis"), ['maxlength'=> 250]);
                   echo("<br>");
                   echo "<input type='file' name='profilna_slika' />";
                   echo("<br>");

                   
                   echo("<input class='btn btn-sm btn-info' type='submit' value='Registruj se'/>");
                   //echo form_submit('registruj_se', 'Registruj se');
                   echo form_close();
             ?>
         </div>
         <div class="col-sm-3 col-md-3 col-lg-3">
             <!-- namerno prazno -->
         </div>
             <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br><br>";
        if(isset($errors)) echo "<font color='red'>$errors</font><br><br>"; ?>
     </div>
     
 </div>