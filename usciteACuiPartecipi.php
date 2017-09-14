<?php
include 'header.php';

?>
    <body style="background: springgreen"></body>
<?php

sec_session_start();
if(login_check($mysqli) == true) {

    $nickname =$_SESSION['nikname'];


    ?>
    <h1 style="text-align: center">Uscite a cui parteciperai</h1>
    <h1 style="text-align: center">o a cui hai partecipato</h1>

    <?php


    $query = "SELECT * from uscita JOIN partecipa ON uscita.ID=partecipa.uscita
       WHERE partecipa.utente='$nickname'";
    $result = mysqli_query($mysqli, $query);


    if (isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>";
    }


    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        ?>
        <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style="border-radius: 80px;height: 620px; background-color: aquamarine">

                    <img style="border-radius: 80px;height: 200px;width: 1900px"<?php if ($row['tipologia'] == 0){ ?>src="img/uscitaMount%202.jpg" style="width: 400px;height: 200px"; <?php }
                    else ?> src="img/uscitaCorsa%202.jpg" style="width: 400px;height: 200px" ;
                         alt="vvvv">
                    <div class="caption">
                        <h3 style="text-align: center"><?php echo $row["titolo"]; ?></h3>
                        <p style="text-align: center">é un'uscita per Bike da <?php if ($row["tipologia"] == 0) {
                                echo 'mountain';
                            } else {
                                echo 'corsa';
                            } ?>, di livello <?php echo $row["difficolta"]; ?> <br>
                            organizata da <?php echo $row["organizzatore"]; ?><br> pedaleremo per <?php echo $row["distanza"]; ?> km, con un
                            dislivello di <?php echo $row["dislivello"]; ?>.<br>
                            L'incontro si terra il <?php echo $row["dataIncontro"]; ?><br> a <?php echo $row["luogo"]; ?><br> alle <?php echo $row["oraIncontro"]; ?>
                        </p>
                        <p style="color: #4CAF50; text-align: center">NOTE: <?php echo $row["note"]; ?></p>


                        <?php
                        $uscita=$row['ID'];
                        $queryConto = "SELECT COUNT(*) as conto FROM partecipa WHERE uscita =$uscita";
                        $resultConto = mysqli_query($mysqli, $queryConto);
                        $rowConto = mysqli_fetch_array($resultConto, MYSQLI_ASSOC);
                        ?>
                        <p style="text-align: center; color: green; font-weight: bolder">
                            all'uscita sono iscritti <?php echo $rowConto["conto"]; ?> utenti
                        </p>
                        <p><a style="color: green; width: 100%" href="tappe.php?uscita=<?php echo $uscita;?>" class="btn btn-primary"
                              role="button">VISUALIZZA TAPPE</a>
                        </p>

                        <?php

                        $queryPartecipa = "SELECT * FROM partecipa WHERE utente='$nickname'&& uscita =$uscita";
                        $resultPartecipa = mysqli_query($mysqli, $queryPartecipa);
                        $rowPartecipa = mysqli_fetch_array($resultPartecipa, MYSQLI_ASSOC);

                           $valutazione=$rowPartecipa['valutazione'];

                            if($row['fine']!=null){

                                if($rowPartecipa['valutazione']!=null){
                                    ?>
                                    <a style="width: 100%" href="visualizzaUscite.php" class="btn btn-primary" role="button" >
                                        hai valutato l'uscita <?php echo $valutazione;?></a>

                                    <?php
                                } else {

                               ?> <form action="valutaUscita.php" method="post" style="align-content: center">
                                    <input type="hidden" value="<?php echo $uscita ?>" name="uscita" ><br>
                                    <label style="text-align: center">Inserisci una valutazione da 1 a 10</label><input style="margin-left: 54px" type="number" name="valutazione" min="1" max="10" required><br>
                                    <br>
                                    <input style="background: red; margin-left: 85px;border-radius: 30px" type="submit" value="invia VALUTAZIONE">
                                </form>


                                <?php
                            }} else {
                                if($rowPartecipa['utente']==$nickname){


                                    ?>
                                    <a style="width: 100%" href="visualizzaUscite.php" class="btn btn-primary" role="button" >sei gia iscritto</a>

                                    <?php

                                }else{

                                    ?>
                                    <a style="width: 100%" href="partecipaUscita1.php?ID=<?php echo $row['ID']; ?>
                            &tipologia=<?php echo $row['tipologia']; ?>" class="btn btn-primary" role="button">PARTECIPA!</a>
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

    echo accedi;?>  <a href="login.php">Login</a><?php
}

