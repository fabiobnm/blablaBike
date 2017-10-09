<?php
include 'header.php';

?>
<?php

sec_session_start();
if(login_check($mysqli) == true) {

    $nickname =$_SESSION['nikname'];
    $uscita=$_GET['uscita'];

    $queryOrg = "SELECT COUNT(*) as conto FROM uscita WHERE ID=$uscita AND organizzatore='$nickname'";
    $mysqli->query($queryOrg)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $resultOrg = mysqli_query($mysqli, $queryOrg);
    $rowOrg = mysqli_fetch_array($resultOrg, MYSQLI_ASSOC);

    if ($rowOrg['conto'] >=1) {


    ?>
    <h1>Visualizza valutazione per l'uscita <?php echo $uscita?> </h1>

    <?php


    $queryVoto = "SELECT * from partecipa where uscita=$uscita && valutazione IN 
     (SELECT valutazione FROM partecipa WHERE valutazione BETWEEN 1 and 10)";
        $mysqli->query($queryVoto)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $resultVoto = mysqli_query($mysqli, $queryVoto);


    if (isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>";
    }


    while ($rowVoto = mysqli_fetch_array($resultVoto, MYSQLI_ASSOC)) {
        $valutazione=$rowVoto["valutazione"];
        ?>
        <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail rad30">

                    <div class="caption">
                        <h3 class="center"><?php echo $rowVoto["utente"]; ?></h3>
                        <p class="center">ha dato una valutazione di <?php echo $valutazione; ?>
                        </p>


                    </div>
                </div>
            </div>
        </div>

        <?php
    }

}
else echo '<h2 style="color: red">Uscita non trovata</h2>';}
else {

    echo 'accedi';?>  <a href="login.php">Login</a><?php
}

?>
</div>
</body>
</html>


