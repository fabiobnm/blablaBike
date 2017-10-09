<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {

    if(isset($_POST['annoprod'])){

        $annoProd=$_POST['annoprod'];
    }

    $nickname = $_SESSION['nikname'];

    echo '<h1>inserisci Mountain Bike</h1>'
    ?>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <form action="procces_insertmount.php" method="post">

                    <label>proprietario</label><br> <input type= "text" value="<?php echo $nickname ?>" name="proprietario" readonly><br>


                    <?php if(isset($_GET['nome'])) {
                    $nome=$_GET['nome'];?>
                    <label>nome bike</label> <br><input type="text" name="nome" value="<?php echo $nome?>" required><?php if (isset($_GET['messaggio1'])) {
                        $messaggio1 = $_GET['messaggio1'];
                        echo " <h1 style='font-size: 20px;color: red'>$messaggio1</h1>";
                    }}else{?><label>nome bike</label> <br><input type="text" name="nome" required><?php if (isset($_GET['messaggio1'])) {
                        $messaggio1 = $_GET['messaggio1'];
                        echo " <h1 style='font-size: 20px;color: red'>$messaggio1</h1>";
                    }}?>


                    <label hidden >tipo</label> <label class="radio-inline" >
                        <input hidden type="radio" name="tipo" id="inlineRadio1" value=1 >
                    </label>
                    <label hidden class="radio-inline">
                        <input hidden type="radio" name="tipo" id="inlineRadio2" value=0 checked>
                    </label>
                    <br>


                    marca
                    <br>
                    <select name="marca" >
                        <option value="<?php echo ' ';?>" ><?php   echo 'seleziona';?>  </option>
                        <?php
                        $query = "SELECT DISTINCT marca FROM bicicletta ";
                        $mysqli->query($query)
                        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                        $result = mysqli_query($mysqli, $query);

                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            $marca=$row['marca'];
                            ?>

                            <option value="<?php echo $marca;?>" ><?php   echo $marca;?>  </option>

                        <?php }?>

                    </select>
                    <?php if(isset($_GET['marca'])) {
                        $marca=$_GET['marca'];?>
                        <input type="text" name="newmarca" value="<?php echo $marca?>" placeholder="nuova marca">
                        <?php if (isset($_GET['messaggio7'])) {
                            $messaggio7 = $_GET['messaggio7'];
                            echo " <h1 class='erroreros'>$messaggio7</h1>";
                        }}else{?><input type="text" name="newmarca" placeholder="nuova marca">
                        <?php if (isset($_GET['messaggio7'])) {
                            $messaggio7 = $_GET['messaggio7'];
                            echo " <h1 class='erroreros'>$messaggio7</h1>";
                        }}?>
                    <br>


                    <?php if(isset($_GET['modello'])) {
                    $modello=$_GET['modello'];?>
                    <label>modello</label> <br><input type="text" name="modello" value="<?php echo $modello?>" required><?php if (isset($_GET['messaggio3'])) {
                        $messaggio3 = $_GET['messaggio3'];
                        echo " <h1 class='erroreros'>$messaggio3</h1>";
                    }}else{?><br>
                        <label>modello</label> <br><input type="text" name="modello" required><?php if (isset($_GET['messaggio3'])) {
                            $messaggio3 = $_GET['messaggio3'];
                            echo " <h1 class='erroreros'>$messaggio3</h1>";
                        }}?><br>


                    <label>ruote</label> <br>
                    <label class="radio-inline" style="color: #4CAF50; font-weight: bold">
                        <input type="radio" name="ruote" id="inlineRadio3" value=26 checked> 26
                    </label>
                    <label class="radio-inline" style="color: deepskyblue; font-weight: bold">
                        <input type="radio" name="ruote" id="inlineRadio4" value=27,5> 27,5
                    </label>
                    <label class="radio-inline" style="color: red; font-weight: bold">
                        <input type="radio" name="ruote" id="inlineRadio5" value=29> 29
                    </label><?php if (isset($_GET['messaggio4'])) {
                        $messaggio4 = $_GET['messaggio4'];
                        echo " <h1 class='erroreros'>$messaggio4</h1>";
                    }?><br>

                    <?php if(isset($_GET['annoFab'])) {
                    $annoFab=$_GET['annoFab'];?>
                    <label>anno fabbricazione</label>
                    <br><input type="number" name="annoFab" min="1900" max="2017"  value="<?php echo $annoFab?>" required><?php if (isset($_GET['messaggio5'])) {
                        $messaggio5 = $_GET['messaggio5'];
                        echo " <h1 class='erroreros'>$messaggio5</h1>";
                    }}else{?>
                    <label>anno fabbricazione</label>
                    <br><input type="number" name="annoFab" min="1900" max="2017"  required><?php if (isset($_GET['messaggio5'])) {
                    $messaggio5 = $_GET['messaggio5'];
                    echo " <h1 class='erroreros'>$messaggio5</h1>";
                    }}?><br>


                    <?php if(isset($_GET['annoAcq'])) {
                    $annoAcq=$_GET['annoAcq'];?>
                    <label>anno acquisto</label>
                    <br><input type="number" name="annoAcq" min="1900" max="2017" value="<?php echo $annoAcq?>" required><?php if (isset($_GET['messaggio6'])) {
                        $messaggio6 = $_GET['messaggio6'];
                        echo " <h1 class='erroreros'>$messaggio6</h1>";
                    }}else{?>
                        <label>anno acquisto</label>
                        <br><input type="number" name="annoAcq" min="1900" max="2017" required><?php if (isset($_GET['messaggio6'])) {
                            $messaggio6 = $_GET['messaggio6'];
                            echo " <h1 class='erroreros'>$messaggio6</h1>";
                        }}?>

                        <?php if (isset($_GET['messaggio2'])) {
                        $messaggio2 = $_GET['messaggio2'];
                        echo " <h1 class='errorepicc'>$messaggio2</h1>";
                    }?><br>


    <?php if(isset($_GET['colore'])) {
        $colore=$_GET['colore'];?>
                    <label>colore</label><br><input type="text" name="colore" value="<?php echo $colore?>" required><?php if (isset($_GET['messaggio12'])) {
                        $messaggio12 = $_GET['messaggio12'];
                        echo " <h1 class='erroreros'>$messaggio12</h1>";
                    }}else{?>
                    <label>colore</label><br><input type="text" name="colore" required><?php if (isset($_GET['messaggio12'])) {
                        $messaggio12 = $_GET['messaggio12'];
                        echo " <h1 class='erroreros'>$messaggio12</h1>";
                    }}?><br>





                    <br>
                    <input class="sublog" type="submit" value="INSERISCI">
                </form>

            </div>
        </div>
    </div>





    <?php









}

else{

    echo "accedi";
}
?>
</div>
</body>
</html>
