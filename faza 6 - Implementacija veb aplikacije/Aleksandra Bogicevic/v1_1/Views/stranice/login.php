 <div class="col-sm-7 col-md-7 col-lg-7 main">
       <form name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" method="post">
<table>
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
        <td><input type="submit" value="Log in"/></td>
    </tr>
</table>
           </form>
 </div>
