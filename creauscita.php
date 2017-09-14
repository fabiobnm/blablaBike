<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION['nikname'];
     $currentdate=date(d/m/y);
    echo '<h1>crea uscita</h1>'
    ?>
    <form action="procces_creauscita.php" method="post">

        <label>organizzatore</label><br> <input type= "text" value="<?php echo $nickname ?>" name="organizzatore" readonly><br>
        <label>titolo</label> <br><input type="text" name="titolo" required><br>
        <label>distanza in km </label><br><input type="number" name="distanza" required><br>
        <label>dislivello in metri</label> <br><input type="number" name="dislivello" max="99" required><br>
        <label>durata</label><br>
        <input type="time" name="durata" max="08:00:00" required>
        <br>
        <label>tipologia</label><br> <label class="radio-inline">
            <input type="radio" name="tipologia" id="inlineRadio1" value=1> corsa
        </label>
        <label class="radio-inline">
            <input type="radio" name="tipologia" id="inlineRadio2" value=0> mountain
        </label><br>
        <label>difficoltà</label><br> <label class="radio-inline" style="color: #4CAF50; font-weight: bold" >
            <input type="radio"  name="difficolta" id="inlineRadio1" value=1> facile
        </label>
        <label class="radio-inline" style="color:deepskyblue; font-weight: bold">
            <input type="radio" name="difficolta" id="inlineRadio2" value=2> media
        </label>
        <label class="radio-inline"style="color: red; font-weight: bold">
            <input type="radio" name="difficolta" id="inlineRadio2" value=3> difficile
        </label><br>
        <label>note</label> <br><input type="text" name="note" ><br>
        <label>data incontro</label><br>
        <input type="date" name="dataIncontro" min="<?php echo $currentdate?>" required>
        <br>
        <label>ora incontro</label> <br><input type="time" name="oraIncontro" required><br>
        <label>luogo</label> <br><input type="text" name="luogo" required><br>
        <label>visibilità </label><br>  <label class="radio-inline" >
            <input type="radio" name="visibile" id="inlineRadio1" value=0> visibile a tutti
        </label>
        <label class="radio-inline">
            <input type="radio" name="visibile" id="inlineRadio2" value=1> privata
        </label><br>





        <br>
        <input style="background: lemonchiffon" type="submit"value="CREA USCITA">
    </form>





    <?php









}

else{

    echo "accedi";
}
