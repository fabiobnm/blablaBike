<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION['nikname'];

echo '<h1>inserisci bike</h1>'
?>

    <div class="row">
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
    <form action="procces_insertbike.php" method="post">

        <label>proprietario</label><br> <input type= "text" value="<?php echo $nickname ?>" name="proprietario" readonly><br>
        <label>nome bike</label> <br><input type="text" name="nome" required><br>
        <label>tipo</label> <br><label class="radio-inline" >
            <input type="radio" name="tipo" id="inlineRadio1" value=1> corsa
        </label>
        <label class="radio-inline">
            <input type="radio" name="tipo" id="inlineRadio2" value=0> mountain
        </label><br>
        <br>
        <lebel style="font-weight: bold">marca</lebel>
        <br>
            <select name="marca" >
                <option value="<?php echo ' ';?>" ><?php   echo 'seleziona';?>  </option>
        <?php
    $query = "SELECT DISTINCT marca FROM bicicletta ";
    $result = mysqli_query($mysqli, $query);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $marca=$row['marca'];
        ?>

                    <option value="<?php echo $marca;?>" ><?php   echo $marca;?>  </option>

                <?php }?>

                </select>
        <input type="text" name="newmarca" placeholder="nuova marca"><br>

        <label>modello</label> <br><input type="text" name="modello" required><br>

        <label>peso</label> <br><input type="number" step="any" name="peso" min="4" max="40">
        <br>
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
        <br><input type="number" name="annoFab" min="1900" max="2017" required><br>
        <label>anno acquisto</label>
        <br><input type="number" name="annoAcq" min="1900" max="2017" required><br>

        <label>colore</label><br><input type="text" name="colore" required><br>





            <br>
    <input style="background: lemonchiffon" type="submit"value="INSERISCI">
</form>

    </div>
    </div>
    </div>





<?php









}

    else{

        echo "accedi";
    }

