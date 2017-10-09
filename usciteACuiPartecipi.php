<?php
include 'header.php';

?>
<?php

sec_session_start();
if(login_check($mysqli) == true) {

    $nickname =$_SESSION['nikname'];


    ?>
    <h3 class="center">Uscite a cui parteciperai</h3>
    <h3 class="center">o a cui hai partecipato</h3>

    <?php


    $query = "SELECT * from uscita JOIN partecipa ON uscita.ID=partecipa.uscita
       WHERE partecipa.utente='$nickname'";
    $mysqli->query($query)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $result = mysqli_query($mysqli, $query);


    if (isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>";
    }


    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        ?>
        <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail thuscite">
        <?php if ($row['tipologia'] == 0){ ?>
                    <img class="immuscite" src="img/uscitaMount%202.jpg"
                         alt="vvvv"><?php }?>

            <?php if ($row['tipologia'] == 1){ ?>
                <img class="immuscite" src="img/uscitaCorsa%202.jpg"
                    alt="vvvv"><?php }?>

                    <div class="caption">
                        <h3 class="center"><?php echo $row["titolo"]; ?></h3>
                        <p class="center">un'uscita per Bike da <?php if ($row["tipologia"] == 0) {
                                echo 'mountain';
                            } else {
                                echo 'corsa';
                            } ?>, di<br> livello <?php echo $row["difficolta"]; ?> <br>
                            organizata da <?php echo $row["organizzatore"]; ?><br> pedaleremo per <?php echo $row["distanza"]; ?> km, con un
                            dislivello di <?php echo $row["dislivello"]; ?>.<br>
                            L'incontro si terra il <?php echo $row["dataIncontro"]; ?><br> a <?php echo $row["luogo"]; ?><br> alle <?php echo $row["oraIncontro"]; ?>
                        </p>
                        <p class="center" style="color: #4CAF50">NOTE: <?php echo $row["note"]; ?></p>


                        <?php
                        $uscita=$row['ID'];
                        $queryConto = "SELECT COUNT(*) as conto FROM partecipa WHERE uscita =$uscita";
                        $mysqli->query($queryConto)
                        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                        $resultConto = mysqli_query($mysqli, $queryConto);
                        $rowConto = mysqli_fetch_array($resultConto, MYSQLI_ASSOC);
                        ?>
                        <p class="center" style="color: green; font-weight: bolder">
                            all'uscita sono iscritti <?php echo $rowConto["conto"]; ?> utenti
                        </p>
                        <p><a class="btn btn-primary tastiuscite" style="color: springgreen" href="tappe.php?uscita=<?php echo $uscita;?>"
                              role="button">VISUALIZZA TAPPE</a>
                        </p>

                        <?php

                        $queryPartecipa = "SELECT * FROM partecipa JOIN bicicletta ON bicicletta.ID=partecipa.bicicletta 
                                        WHERE utente='$nickname'&& uscita =$uscita";
                        $mysqli->query($queryPartecipa)
                        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                        $resultPartecipa = mysqli_query($mysqli, $queryPartecipa);
                        $rowPartecipa = mysqli_fetch_array($resultPartecipa, MYSQLI_ASSOC);

                           $valutazione=$rowPartecipa['valutazione'];

                            if($row['fine']!=null){

                                if($rowPartecipa['valutazione']!=null){
                                    ?>
                                    <a class="btn btn-primary tastiuscite" style="width: 100%;border-radius: 50px" href="visualizzaUscite.php"  role="button" >
                                        hai valutato l'uscita <?php echo $valutazione;?></a>

                                    <?php
                                } else {

                               ?> <form action="valutaUscita.php" method="post">
                                    <input type="hidden" value="<?php echo $uscita ?>" name="uscita" ><br>
                                    <label class="center">Inserisci una valutazione da 1 a 10</label>
                                        <input class="margvalutaz" type="number" name="valutazione" min="1"  ><?php if (isset($_GET['messaggio0'])) {
                                            $messaggio0 = $_GET['messaggio0'];
                                            echo " <h1 class='errorepicc'>$messaggio0</h1>";
                                        }?><br>
                                    <br>
                                    <input class="subvalut" type="submit" value="invia VALUTAZIONE">
                                </form>


                                <?php
                            }} else {
                                if($rowPartecipa['utente']==$nickname){


                                    ?>
                                    <a class="btn btn-primary tastiuscite" style="color: springgreen;" role="button" >ISCRITTO con <?php echo $rowPartecipa['nome']?></a>

                                    <?php

                                }else{

                                    ?>
                                    <a class="btn btn-primary tastiuscite" href="partecipaUscita1.php?ID=<?php echo $row['ID']; ?>
                            &tipologia=<?php echo $row['tipologia']; ?>" role="button">PARTECIPA!</a>
                                    <?php

                                }


                            }

                            ?>


                    </div>
                </div>
            </div>
        </div>

        <?php
    }

}
else {

    echo 'accedi';?>  <a href="login.php">Login</a><?php
}
?>
</div>
</body>
</html>


