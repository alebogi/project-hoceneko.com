<?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>


 <div class="col-sm-7 col-md-7 col-lg-7 main">
     
     
     <?php echo form_open("Gost/loginSubmit","method=post"); ?>
                    <!-- <form class="podrskaForma"  method="post"> -->
                        <label for="temaPodrska">
                            Korisnicko ime: 
                        </label>
                        <br/>
                        <input type="text" placeholder="username..." rows="1"  name="username" required="yes">
                        <br/> <br/>
                        <label for="porukaPodrska">
                            Sifra: 
                        </label>
                        <br/>
                        <textarea placeholder="sifra..." rows="1"  name="pass" required="yes"></textarea>
                        <br/>
                        <br/>
                        <button type="submit" class="btn">Log in</button>
                    <!-- </form> -->
                    <?php echo form_close(); ?>
 </div>


            
