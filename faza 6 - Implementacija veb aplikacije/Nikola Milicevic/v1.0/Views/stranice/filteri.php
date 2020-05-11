<div class="col-sm-7 col-md-7 col-lg-7 main">
<?php
    if(!empty($errors)) echo "<span style='color:red'>$errors</span>";

    echo form_open("$controller/filtriraj","method=post");    
    echo "<br/>Datum : od <br/>";
    echo form_input("datum_od",set_value("datum_od"),'','date'); 
    echo "<br/>Datum : do <br/>";
    echo form_input("datum_do",set_value("datum_do"),'','date'); 
    echo "<br>Mesto:<br/>";
    echo form_input("mesto",set_value("mesto")); 
    echo "<br/>Vreme : od <br/>";
    echo form_input("vreme_od",set_value("vreme_od"),'','time'); 
    echo "<br/>Vreme : do <br/>";
    echo form_input("vreme_do",set_value("vreme_do"),'','time'); 
    echo "<br/><br/>";
    echo form_submit("primeni", "Primeni");
    echo form_close();
?>
</div>
