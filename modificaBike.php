<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];
    $ID=$_GET['ID'];

    $controllo="SELECT count(*) as controllo FROM bicicletta
                       WHERE ID = $ID and proprietario='$nickname'";
    $infocontrollo = mysqli_query($mysqli, $controllo);
    $ooo = mysqli_fetch_array($infocontrollo, MYSQLI_ASSOC);

    $provola =  $ooo['controllo'];

    if ($provola > 0) {

    if(isset($_SESSION['nikname'])){

        $modificaBike="SELECT * FROM bicicletta
                       WHERE ID = $ID and proprietario='$nickname'";
        $biciInfo = mysqli_query($mysqli, $modificaBike);
        $row = mysqli_fetch_array($biciInfo, MYSQLI_ASSOC);
        $nome=$row['nome'];
        $tipo=$row['tipo'];
        $marca=$row['marca'];
        $modello=$row['modello'];
        $peso=$row['peso'];
        $ruote=$row['ruote'];
        $annoFab=$row['annoFab'];
        $annoAcq=$row['annoAcq'];
        $colore=$row['colore'];



        echo '<h1>Modifica bike</h1>'
?>
<form action="procces_modificabike.php" method="post">

    <label>proprietario</label><br> <input type= "text" value="<?php echo $nickname ?>" name="proprietario" readonly><br>
    <label>nome bike</label> <br><input type="text" value="<?php echo $nome ?>" name="nome" readonly><br>
    <label>tipo</label> <br><label class="radio-inline" required>
        <input type="radio" name="tipo" id="inlineRadio1" value=1> corsa
    </label>
    <label class="radio-inline">
        <input type="radio" name="tipo" id="inlineRadio2" value=0> mountain
    </label><br>
    <label>marca</label> <br><input type="text" name="marca" value="<?php echo $marca; ?>" required><br>
    <label>modello</label> <br><input type="text" name="modello" value="<?php echo $modello; ?>" required><br>
    <label>peso</label> <br><input type="number" name="peso"value="<?php echo $peso; ?>" ><br>
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
    <br><input type="number" name="annoFab" min="1900" max="2017" value="<?php echo $annoFab; ?>" required><br>
    <label>anno acquisto</label>
    <br><input type="number" name="annoAcq" min="1900" max="2017" value="<?php echo $annoAcq; ?>"required><br>

    <label>colore</label><br><input type="text" name="colore" value="<?php echo $colore; ?>" required><br>





    <br>
    <input style="background: lemonchiffon" type="submit"value="MODIFICA">
</form>





<?php



}} else {echo '<h1>errore non puoi modificare la bicicletta</h1>';}

    }