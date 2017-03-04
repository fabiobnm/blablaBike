<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION['nikname'];


    ?>
    <form action="procces_creauscita.php" method="post">

        organizzatore<br> <input type= "text" value="<?php echo $nickname ?>" name="organizzatore" readonly><br>
        titolo <br><input type="text" name="titolo" ><br>
        distanza in km <br><input type="number" name="distanza" ><br>
        dislivello in metri <br><input type="number" name="dislivello" ><br>
        tipologia<br> <label class="radio-inline">
            <input type="radio" name="tipologia" id="inlineRadio1" value=1> corsa
        </label>
        <label class="radio-inline">
            <input type="radio" name="tipologia" id="inlineRadio2" value=0> mountain
        </label><br>
        difficoltà<br> <label class="radio-inline" style="color: #4CAF50; font-weight: bold" >
            <input type="radio"  name="difficolta" id="inlineRadio1" value=1> facile
        </label>
        <label class="radio-inline" style="color:deepskyblue; font-weight: bold">
            <input type="radio" name="difficolta" id="inlineRadio2" value=2> media
        </label>
        <label class="radio-inline"style="color: red; font-weight: bold">
            <input type="radio" name="difficolta" id="inlineRadio2" value=3> difficile
        </label><br>
        note <br><input type="text" name="note" ><br>
        <label>data6565656 incontro:</label>
        <input type="date" name="dataIncontro" min="2017-01-01">
        <br>
        ora incontro <br><input type="time" name="oraIncontro" ><br>
        luogo <br><input type="text" name="luogo" ><br>
            visibilità <br>  <label class="radio-inline">
            <input type="radio" name="visibile" id="inlineRadio1" value=0> visibile a tutti
        </label>
        <label class="radio-inline">
            <input type="radio" name="visibile" id="inlineRadio2" value=1> privata
        </label><br>





        <br>
        <input style="background: lemonchiffon" type="submit"value="ISCRIVITI">
    </form>





    <?php









}

else{

    echo "accedi";
}
