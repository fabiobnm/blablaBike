<?php
include 'header.php';


sec_session_start();


$annuncio=$_GET['IDannuncio'];

$queryS = "SELECT count(*) AS conto FROM annuncio WHERE IDannuncio=$annuncio";
$mysqli->query($queryS)
or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
$resultS = mysqli_query($mysqli, $queryS);
$rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC);

if($rowS['conto']>=1) {

$query = "SELECT * FROM commento WHERE annuncio='$annuncio'";
    $mysqli->query($query)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
$result = mysqli_query($mysqli, $query);
echo 'commenti annuncio N ';
echo $_GET['IDannuncio'];

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    ?>
    <div class="row">
        <div class="col-sm-6 col-md-4">


                <div class="chat">

                    <?php if ($row["utente"]!='anonymous'){?>
                    <a href="profilo.php?profilo=<?php echo $row["utente"]; ?>">
                        <h3 class="commenti"><?php echo $row["utente"]; ?></h3>
                    </a><?php } else{?>
                        <h3 class="commenti"><?php echo $row["utente"]; ?></h3>
                    <?php
                    }?>


                    <h3 class="biancocomm">
                        <?php echo $row["testo"]; ?>
                    </h3>
                    <p style="color: white"><?php echo $row["data"]; ?></p>

                </div>
        </div>
    </div>

    <?php
}
?>


<form action="inserisciCommento.php" method="post">
Inserisci un commento: <input type="text" name="testo" required>
        <input type="hidden" value="<?php echo $annuncio;?>" name="annuncio">
    <input type="submit" class="sublog" value="INVIA">

</form> <?php } else echo '<h1 style="color: red">annuncio non trovato</h1>';

?>
</div>
</body>
</html>