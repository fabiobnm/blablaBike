<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION['nikname'];



    echo '<h1 class="center">Tappe</h1>';
    if (isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];

    }
    if(isset($_GET['uscita'])) {


        $utente=$_SESSION['nikname'];
        $uscita=$_GET['uscita'];
        $query = "SELECT * FROM tappa WHERE uscita=$uscita";
        $mysqli->query($query)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $result = mysqli_query($mysqli, $query);


        $queryS = "SELECT count(*) AS conto FROM uscita WHERE ID=$uscita AND (visibile=0 OR organizzatore='$utente' OR (organizzatore IN 
           (SELECT utente from segue WHERE seguitoDa='$utente' and approvato=1)OR organizzatore IN
            (SELECT seguitoDa from segue WHERE utente='$utente'AND approvato=1)))";
        $mysqli->query($queryS)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $resultS = mysqli_query($mysqli, $queryS);
        $rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC);

        if($rowS['conto']>=1) {

            $queryLunghezza = "SELECT SUM(lunghezza) as somma FROM tappa WHERE uscita=$uscita";
            $mysqli->query($queryLunghezza)
            or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
            $resultLunghezza = mysqli_query($mysqli, $queryLunghezza);
            $rowLunghezza = mysqli_fetch_array($resultLunghezza, MYSQLI_ASSOC);
            $somma = $rowLunghezza['somma'];

            $queryTot = "SELECT distanza,nascosto FROM uscita WHERE ID=$uscita";
            $mysqli->query($queryTot)
            or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
            $resultTot = mysqli_query($mysqli, $queryTot);
            $rowTot = mysqli_fetch_array($resultTot, MYSQLI_ASSOC);
            $distanzaUscita = $rowTot['distanza'];
            $nascosto=$rowTot['nascosto'];
            $kmRimanenti = ($distanzaUscita - $somma);
            echo '<h2 class="center"> uscita ';
            echo $uscita;
            echo '</h2>';

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                $tipo = $row['tipo'];

                ?>
                <div class=" ">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail rad30">

                            <div class="caption">
                                <h3 class="center">Tappa n <?php echo $row["numero"]; ?></h3><br>
                                <p class="center">Nome: <?php echo $row["nome"]; ?>
                                    Lunghezza: <?php echo $row["lunghezza"]; ?>Km <br>

                                    <?php if ($tipo == 1) {
                                        echo 'Pianeggiante';
                                    } else if ($tipo == 2) {
                                        echo 'discesa';
                                    } else {
                                        echo 'discesa';
                                    } ?><br>luogo: <?php echo $row["luogo"]; ?>


                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }

            if($kmRimanenti==0 && $nascosto!=1){?>
                <div class="thumbnail tappe">
                    <a href="pubblicaUscita.php?uscita=<?php echo $uscita;?>" class="center"><h3 class="pubuscita">Pubblica Uscita</h3></a>
                </div>

         <?php   }


            if ($kmRimanenti > 0) {




                $queryOrg = "SELECT organizzatore FROM uscita WHERE ID=$uscita";
                $mysqli->query($queryOrg)
                or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                $resultOrg = mysqli_query($mysqli, $queryOrg);
                $rowOrg = mysqli_fetch_array($resultOrg, MYSQLI_ASSOC);

                if ($rowOrg['organizzatore'] == $nickname) {
                    ?>
                    <div class=" ">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail rad30">

                                <?php echo '<h3 class="center">mancano ';
                                echo $kmRimanenti;
                                echo 'Km, da inserire </h3>';


                                ?>


                                <form action="tappeInserisci2.php" method="post">

                                    <input type="hidden" name="uscita" value="<?php echo $uscita; ?>">

                    <?php if(isset($_GET['nome'])) {
                        $nome=$_GET['nome'];?>
                                    <label>nome tappa</label><br> <input type="text" value="<?php echo $nome?>" name="nome" ><?php if (isset($_GET['messaggio0'])) {
                                        $messaggio0 = $_GET['messaggio0'];
                                        echo " <h1 class='erroreros'>$messaggio0</h1>";
                                    }}else{?><label>nome tappa</label><br> <input type="text" name="nome" ><?php if (isset($_GET['messaggio0'])) {
                        $messaggio0 = $_GET['messaggio0'];
                        echo " <h1 class='erroreros'>$messaggio0</h1>";
                    }}?><br>


                                    <label>tipo</label> <br>
                                    <label class="radio-inline" style="color:deepskyblue; font-weight: bold">
                                        <input type="radio" name="tipo" id="inlineRadio1" value=1 checked> pianeggiante
                                    </label>
                                    <label class="radio-inline" style="color: #4CAF50; font-weight: bold">
                                        <input type="radio" name="tipo" id="inlineRadio2" value=2> discesa
                                    </label>
                                    <label class="radio-inline" style="color: red; font-weight: bold">
                                        <input type="radio" name="tipo" id="inlineRadio3" value=3> salita
                                    </label><?php if (isset($_GET['messaggio1'])) {
                                        $messaggio1 = $_GET['messaggio1'];
                                        echo " <h1 class='erroreros'>$messaggio1</h1>";
                                    }?>
                                    <br>
                                    <label>Lunghezzaa</label>
                                    <br>


                    <?php if(isset($_GET['Lunghezza'])) {
                        $lunghezza=$_GET['Lunghezza'];?>
                                    <input type="number" name="Lunghezza" max="<?php echo $kmRimanenti ?>" value="<?php echo $lunghezza?>">Km<?php if (isset($_GET['messaggio2'])) {
                                        $messaggio2 = $_GET['messaggio2'];
                                        echo " <h1 class='erroreros'>$messaggio2</h1>";
                                    }}else{?><input type="number" name="Lunghezza" max="<?php echo $kmRimanenti ?>">Km<?php if (isset($_GET['messaggio2'])) {
                        $messaggio2 = $_GET['messaggio2'];
                        echo " <h1 class='erroreros'>$messaggio2</h1>";
                    }}?><br>
                                    <label>Luogo</label>
                                    <br>

                    <?php if(isset($_GET['Luogo'])) {
                        $luogo=$_GET['Luogo'];?>
                                    <input type="text" name="Luogo" value="<?php echo $luogo?>" required><?php if (isset($_GET['messaggio3'])) {
                                        $messaggio3 = $_GET['messaggio3'];
                                        echo " <h1 class='erroreros'>$messaggio3</h1>";
                                    }}else{?><input type="text" name="Luogo" required><?php if (isset($_GET['messaggio3'])) {
                        $messaggio3 = $_GET['messaggio3'];
                        echo " <h1 class='erroreros'>$messaggio3</h1>";
                    }}?><br>

                                    <br>
                                    <input class="sublog" type="submit" value="INSERISCI">
                                </form>

                            </div>
                        </div>
                    </div>


                    <?php
                }
            }


        } else{echo '<h1 style="color: red">uscita NON esiste</h1>';}

        }










}

else{

    echo "accedi";
}
?>
</div>
</body>
</html>


