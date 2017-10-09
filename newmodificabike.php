<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];
    $ID=$_GET['ID'];
    $tipo=$_GET['tipo'];

    $controllo="SELECT count(*) as controllo FROM bicicletta
                       WHERE ID = $ID and proprietario='$nickname'";
    $mysqli->query($controllo)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $infocontrollo = mysqli_query($mysqli, $controllo);
    $ooo = mysqli_fetch_array($infocontrollo, MYSQLI_ASSOC);

    $provola =  $ooo['controllo'];

    if ($provola > 0) {

        if(isset($_SESSION['nikname'])){

            if($tipo==1) {

                $modificaBike = "SELECT * FROM bicicletta
                       WHERE ID = $ID and proprietario='$nickname'";
                $mysqli->query($modificaBike)
                or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                $biciInfo = mysqli_query($mysqli, $modificaBike);
                $row = mysqli_fetch_array($biciInfo, MYSQLI_ASSOC);
                $nome = $row['nome'];
                $tipo = $row['tipo'];
                $marca = $row['marca'];
                $modello = $row['modello'];
                $peso = $row['peso'];
                $ruote = $row['ruote'];
                $annoFab = $row['annoFab'];
                $annoAcq = $row['annoAcq'];
                $colore = $row['colore'];


                echo '<h1>Modifica bike da corsa</h1>'
                ?>
                <form action="procces_modificacorsabike.php" method="post">
                    <input type="hidden" name="ID" id="inlineRadio0" value="<?php echo $ID?>" >

                    <label>proprietario</label><br> <input type="text" value="<?php echo $nickname ?>"
                                                           name="proprietario" readonly><br>
                    <label>nome bike</label> <br><input type="text" name="nome" value="<?php echo $nome ?>" readonly>
                    <?php if (isset($_GET['messaggio1'])) {
                        $messaggio1 = $_GET['messaggio1'];
                        echo " <h1 class='erroreros'>$messaggio1</h1>";
                    }?><br>

                    <label class="radio-inline">
                        <input type="hidden" name="tipo" id="inlineRadio1" value=1>
                    </label>


                    <label>marca</label> <br><input type="text" name="marca" value="<?php echo $marca; ?>" ><?php if (isset($_GET['messaggio7'])) {
                        $messaggio7 = $_GET['messaggio7'];
                        echo " <h1 class='erroreros'>$messaggio7</h1>";
                    }?><br>
                    <label>modello</label> <br><input type="text" name="modello" value="<?php echo $modello; ?>"
                                                      required><?php if (isset($_GET['messaggio3'])) {
                        $messaggio3 = $_GET['messaggio3'];
                        echo " <h1 class='erroreros'>$messaggio3</h1>";
                    }?><br>
                    <label>peso</label> <br><input type="number" name="peso" value="<?php echo $peso; ?>" required><?php if (isset($_GET['messaggio4'])) {
                        $messaggio4 = $_GET['messaggio4'];
                        echo " <h1 class='erroreros'>$messaggio4</h1>";
                    }?><br>
                    <input type="hidden" name="ruote" id="inlineRadio2" value=0>


                    <br>
                    <label>anno fabbricazione</label>
                    <br><input type="number" name="annoFab" min="1900" max="2017" value="<?php echo $annoFab; ?>"
                               required><?php if (isset($_GET['messaggio5'])) {
                        $messaggio5 = $_GET['messaggio5'];
                        echo " <h1 class='erroreros'>$messaggio5</h1>";
                    }?><br>
                    <label>anno acquisto</label>
                    <br><input type="number" name="annoAcq" min="1900" max="2017" value="<?php echo $annoAcq; ?>"
                               required><?php if (isset($_GET['messaggio6'])) {
                        $messaggio6 = $_GET['messaggio6'];
                        echo " <h1 class='erroreros'>$messaggio6</h1>";
                    }?><?php if (isset($_GET['messaggio2'])) {
                        $messaggio2 = $_GET['messaggio2'];
                        echo " <h1 class='errorepicc'>$messaggio2</h1>";
                    }?><br>

                    <label>colore</label><br><input type="text" name="colore" value="<?php echo $colore; ?>"
                                                    required><?php if (isset($_GET['messaggio12'])) {
                        $messaggio12 = $_GET['messaggio12'];
                        echo " <h1 class='erroreros'>$messaggio12</h1>";
                    }?><br>


                    <br>
                    <input class="sublog" type="submit" value="MODIFICA">
                </form>


                <?php


            } else
            {$modificaBike = "SELECT * FROM bicicletta
                       WHERE ID = $ID and proprietario='$nickname'";
                $mysqli->query($modificaBike)
                or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                $biciInfo = mysqli_query($mysqli, $modificaBike);
                $row = mysqli_fetch_array($biciInfo, MYSQLI_ASSOC);
                $nome = $row['nome'];
                $tipo = $row['tipo'];
                $marca = $row['marca'];
                $modello = $row['modello'];
                $peso = $row['peso'];
                $ruote = $row['ruote'];
                $annoFab = $row['annoFab'];
                $annoAcq = $row['annoAcq'];
                $colore = $row['colore'];


                echo '<h1>Modifica mountainbike</h1>'
                ?>
                <form action="procces_modificabike.php" method="post">
                    <input type="hidden" name="ID" id="inlineRadio1" value="<?php echo $ID?>" >
                    <label>proprietario</label><br> <input type="text" value="<?php echo $nickname ?>"
                                                           name="proprietario" readonly><br>
                    <label>nome bike</label> <br><input type="text" name="nome" value="<?php echo $nome ?>"
                                                    readonly    ><?php if (isset($_GET['messaggio1'])) {
                        $messaggio1 = $_GET['messaggio1'];
                        echo " <h1 class='erroreros'>$messaggio1</h1>";
                    }?><br>

                    <label class="radio-inline">
                        <input type="hidden" name="tipo" id="inlineRadio2" value=0>
                    </label>


                    <label>marca</label> <br><input type="text" name="marca" required value="<?php echo $marca; ?>" ><?php if (isset($_GET['messaggio7'])) {
                        $messaggio7 = $_GET['messaggio7'];
                        echo " <h1 class='erroreros'>$messaggio7</h1>";
                    }?><br>
                    <label>modello</label> <br><input type="text" name="modello"  required value="<?php echo $modello; ?>"
                                                      ><?php if (isset($_GET['messaggio3'])) {
                        $messaggio3 = $_GET['messaggio3'];
                        echo " <h1 class='erroreros'>$messaggio3</h1>";
                    }?><br>
                    <label>ruote</label> <br>
                        <?php  if($ruote==26){ ?>

                        <label class="radio-inline" style="color: #4CAF50; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio3" value=26 checked> 26
                        </label>
                        <label class="radio-inline" style="color: deepskyblue; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio4" value=27,5> 27,5
                        </label>
                        <label class="radio-inline" style="color: red; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio5" value=29> 29
                        </label>

                    <?php }else if($ruote==29){?>


                        <label class="radio-inline" style="color: #4CAF50; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio3" value=26> 26
                        </label>
                        <label class="radio-inline" style="color: deepskyblue; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio4" value=27,5> 27,5
                        </label>
                        <label class="radio-inline" style="color: red; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio5" value=29 checked> 29
                        </label>


                    <?php }else{?>


                        <label class="radio-inline" style="color: #4CAF50; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio3" value=26> 26
                        </label>
                        <label class="radio-inline" style="color: deepskyblue; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio4" value=27,5 checked> 27,5
                        </label>
                        <label class="radio-inline" style="color: red; font-weight: bold">
                            <input type="radio" name="ruote" id="inlineRadio5" value=29> 29
                        </label>

                        <?php
                    }?><?php if (isset($_GET['messaggio4'])) {
                        $messaggio4 = $_GET['messaggio4'];
                        echo " <h1 class='erroreros'>$messaggio4</h1>";
                    }?>
                    <br>


                    <br>
                    <label>anno fabbricazione</label>
                    <br><input type="number" name="annoFab" min="1900" max="2017" value="<?php echo $annoFab; ?>"
                               required><?php if (isset($_GET['messaggio5'])) {
                        $messaggio5 = $_GET['messaggio5'];
                        echo " <h1 class='erroreros'>$messaggio5</h1>";
                    }?><br>
                    <label>anno acquisto</label>
                    <br><input type="number" name="annoAcq" min="1900" max="2017" value="<?php echo $annoAcq; ?>"
                               required><?php if (isset($_GET['messaggio6'])) {
                        $messaggio6 = $_GET['messaggio6'];
                        echo " <h1 class='erroreros'>$messaggio6</h1>";
                    }?><?php if (isset($_GET['messaggio2'])) {
                        $messaggio2 = $_GET['messaggio2'];
                        echo " <h1 class='errorepicc'>$messaggio2</h1>";
                    }?><br>

                    <label>colore</label><br><input type="text" name="colore" value="<?php echo $colore; ?>"
                                                    required><?php if (isset($_GET['messaggio12'])) {
                        $messaggio12 = $_GET['messaggio12'];
                        echo " <h1 class='erroreros'>$messaggio12</h1>";
                    }?><br>


                    <br>
                    <input class="sublog" type="submit" value="MODIFICA">
                </form>


                <?php

            }

        }} else {echo '<h1>errore non puoi modificare la bicicletta</h1>';
    echo $nickname;echo $ID;}

}
?>
</div>
</body>
</html>