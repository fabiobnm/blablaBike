<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];
    $ID=$_GET['ID'];

    if(isset($_SESSION['nikname'])){

        if($stmt=$mysqli->prepare("SELECT * FROM bicicletta WHERE ID = '$ID'")){
            $stmt->bind_param('i',$ID );
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();

            if($stmt->num_rows == 1){
                $stmt->bind_result($nickname,$ID, $nome,$tipo,$marca, $modello,$peso,$ruote,$annoFab,$annoAcq,$colore);
                $stmt->fetch();

echo '<h1>inserisci bike</h1>'
?>
<form action="procces_insertbike.php" method="post">

    <label>proprietario</label><br> <input type= "text" value="<?php echo $nickname ?>" name="proprietario" readonly><br>
    <label>nome bike</label> <br><input type="text" value="<?php echo $nome ?>" name="nome" ><br>
    <label>tipo</label> <br><label class="radio-inline">
        <input type="radio" name="tipo" id="inlineRadio1" value=1> corsa
    </label>
    <label class="radio-inline">
        <input type="radio" name="tipo" id="inlineRadio2" value=0> mountain
    </label><br>
    <label>marca</label> <br><input type="text" name="marca" ><br>
    <label>modello</label> <br><input type="text" name="modello" ><br>
    <label>peso</label> <br><input type="number" name="peso" ><br>
    <label>ruote</label> <br><label class="radio-inline">
        <input type="radio" name="ruote" id="inlineRadio1" value=0> unknow
    </label>
    <label class="radio-inline"style="color: #4CAF50; font-weight: bold">
        <input type="radio" name="ruote" id="inlineRadio2" value=26> 26
    </label>
    <label class="radio-inline"style="color: deepskyblue; font-weight: bold">
        <input type="radio" name="ruote" id="inlineRadio2" value=27,5> 27,5
    </label>
    <label class="radio-inline"style="color: red; font-weight: bold">
        <input type="radio" name="ruote" id="inlineRadio2" value=29> 29
    </label><br>
    <label>anno fabbricazione</label>
    <br><input type="number" name="annoFab" min="1900" max="2017"><br>
    <label>anno acquisto</label>
    <br><input type="number" name="annoAcq" min="1900" max="2017"><br>

    <label>colore</label><br><input type="text" name="colore" ><br>





    <br>
    <input style="background: lemonchiffon" type="submit"value="INSERISCI">
</form>





<?php



}
        }
    }