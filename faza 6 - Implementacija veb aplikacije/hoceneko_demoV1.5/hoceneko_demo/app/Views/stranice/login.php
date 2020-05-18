<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
     * @coauthor Nikola Milicevic 0387/17
     */
?>

<div class="col-sm-8 col-md-8 col-lg-8 main justify-content-center">
    <h1> Ulogujte se:</h1>
       <form class="loginForma justify-content-center" name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" method="post">
           <div class="row justify-content-center">
              
               <table class="loginTable">
                <tr>
                    <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br><br>"; ?>
                    <td>Korisnicko ime:</td>
                    <td><input type="text" name="korisnicko_ime" 
                               value="<?= set_value('korisnicko_ime') ?>"/></td>
                    <td><font color='red'>
                        <?php if(!empty($errors['korisnicko_ime'])) 
                            echo $errors['korisnicko_ime'];
                        ?></font></td>
                </tr>
                <tr>
                    <td>Lozinka:</td> 
                    <td><input type="password" name="lozinka"/></td>
                    <td><font color='red'>
                         <?php if(!empty($errors['lozinka'])) 
                            echo $errors['lozinka'];
                        ?></font></td>
                </tr>
                <tr>
                    
                </tr>
            </table>
               
           </div>
           <div class="row justify-content-center">
                   <td><input class="btn btn-sm btn-info" type="submit" value="Log in"/></td>
               </div>
      </form>
    
    
 </div>
