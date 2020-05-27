<?php
    /**
     * @author Aleksandra Bogicevic 0390/17
     */

?>



<!-- main deo gde se ubacuju stranice -->
<div class="col-sm-8 col-md-8 col-lg-8 main">
                
                <!-- podrska-->
                <div class="row podrskaFormWrapper justify-content-center">
                    <?php echo form_open("$controller/podrskaPotvrda","method=post"); ?>
                    <!-- <form class="podrskaForma"  method="post"> -->
                        <label for="temaPodrska">
                            Tema: 
                        </label>
                        <br/>
                        <input type="textarea" placeholder="Tema..." rows="1" id="temaPodrska" name="temaPodrska" required="yes">
                        <br/> <br/>
                        <label for="porukaPodrska">
                            Poruka: 
                        </label>
                        <br/>
                        <textarea placeholder="Pisite nam..." rows="1" id="porukaPodrska" name="porukaPodrska" required="yes"></textarea>
                        <br/>
                        <br/>
                        <button type="submit" class="btn">Posalji</button>
                    <!-- </form> -->
                    <?php echo form_close(); ?>
                </div>
                <!-- kraj podrska-->

                 
            </div>
            <!-- kraj main dela koji ce se ubacivati - "stranice" -->