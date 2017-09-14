<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION['nikname'];



    echo '<h1>Tappe</h1>';
    if (isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>";
    }
    if(isset($_GET['uscita'])) {


        $utente=$_SESSION['nikname'];
        $uscita=$_GET['uscita'];
        $query = "SELECT * FROM tappa WHERE uscita=$uscita";
        $result = mysqli_query($mysqli, $query);


        $queryS = "SELECT count(*) AS conto FROM uscita WHERE ID=$uscita AND (visibile=0 OR (organizzatore IN 
           (SELECT utente from segue WHERE seguitoDa='$utente' and approvato=1)OR organizzatore IN
            (SELECT seguitoDa from segue WHERE utente='$utente'AND approvato=1)))";
        $resultS = mysqli_query($mysqli, $queryS);
        $rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC);

        if($rowS['conto']>=1) {

            $queryLunghezza = "SELECT SUM(lunghezza) as somma FROM tappa WHERE uscita=$uscita";
            $resultLunghezza = mysqli_query($mysqli, $queryLunghezza);
            $rowLunghezza = mysqli_fetch_array($resultLunghezza, MYSQLI_ASSOC);
            $somma = $rowLunghezza['somma'];

            $queryTot = "SELECT distanza,nascosto FROM uscita WHERE ID=$uscita";
            $resultTot = mysqli_query($mysqli, $queryTot);
            $rowTot = mysqli_fetch_array($resultTot, MYSQLI_ASSOC);
            $distanzaUscita = $rowTot['distanza'];
            $nascosto=$rowTot['nascosto'];
            $kmRimanenti = ($distanzaUscita - $somma);
            echo '<h3> uscita ';
            echo $uscita;
            echo '</h3>';

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                $tipo = $row['tipo'];

                ?>
                <div class=" ">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" style="border-radius: 30px">

                            <div class="caption">
                                <h3 style="text-align: center">tappa n°<?php echo $row["numero"]; ?></h3>
                                <p style="text-align: center">nome: <?php echo $row["nome"]; ?>
                                    , lunghezza: <?php echo $row["lunghezza"]; ?>Km <br>

                                    <?php if ($tipo == 1) {
                                        echo 'pianeggiante';
                                    } else if ($tipo == 2) {
                                        echo 'discesa';
                                    } else {
                                        echo 'discesa';
                                    } ?> luogo: <?php echo $row["luogo"]; ?>


                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }

            if($kmRimanenti==0 && $nascosto!=1){?>
                <div class="thumbnail" style="float: left;border-radius: 30px;width: 300px;height: 100px;background-color: #4CAF50">
                    <a href="pubblicaUscita.php?uscita=<?php echo $uscita;?>" style="text-align: center"><h3 style="text-align: center;margin-top: 40px">Pubblica Uscita</h3></a>
                </div>

         <?php   }


            if ($kmRimanenti > 0) {




                $queryOrg = "SELECT organizzatore FROM uscita WHERE ID=$uscita";
                $resultOrg = mysqli_query($mysqli, $queryOrg);
                $rowOrg = mysqli_fetch_array($resultOrg, MYSQLI_ASSOC);

                if ($rowOrg['organizzatore'] == $nickname) {
                    ?>
                    <div class=" ">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail" style="border-radius: 30px">

                                <?php echo '<h3 style="text-align: center">mancano ';
                                echo $kmRimanenti;
                                echo 'Km, da inserire </h3>';


                                ?>


                                <form action="tappeInserisci2.php" method="post">

                                    <input type="hidden" name="uscita" value="<?php echo $uscita; ?>">
                                    <label>nome tappa</label><br> <input type="text" name="nome" required><br>
                                    <label>tipo</label> <br>
                                    <label class="radio-inline" style="color:deepskyblue; font-weight: bold">
                                        <input type="radio" name="tipo" id="inlineRadio1" value=1> pianeggiante
                                    </label>
                                    <label class="radio-inline" style="color: #4CAF50; font-weight: bold">
                                        <input type="radio" name="tipo" id="inlineRadio2" value=2> discesa
                                    </label>
                                    <label class="radio-inline" style="color: red; font-weight: bold">
                                        <input type="radio" name="tipo" id="inlineRadio3" value=3> salita
                                    </label>
                                    <br>
                                    <label>Lunghezza</label>
                                    <br><input type="number" name="Lunghezza" max="<?php echo $kmRimanenti ?>" required>Km<br>
                                    <label>Luogo</label>
                                    <br><input type="text" name="Luogo" required><br>

                                    <br>
                                    <input style="background: lemonchiffon" type="submit" value="INSERISCI">
                                </form>

                            </div>
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

