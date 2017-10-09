<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {

    $nickname=$_SESSION['nikname'];
    $query="SELECT utente, annuncio,prezzo, annuncio.bicicletta as bici, bicicletta.nome from richiestaacquisto join annuncio on IDannuncio= richiestaacquisto.annuncio
            JOIN bicicletta ON bicicletta.ID=annuncio.bicicletta
            where annuncio in 
            (SELECT IDannuncio from annuncio where venditore='$nickname')";
    $mysqli->query($query)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $result=mysqli_query($mysqli,$query);

    echo '<h3 class="center">Richieste dal Mercatino</h3>';
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

        ?> <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail rad80">

                    <img src="img/richiestaacquisto.svg"  alt="vvvv" class="immaginiVendita">
                    <div class="caption">
                        <a href="profilo.php?profilo=<?php echo $row["utente"];?>"><h3 class="center"><?php echo $row["utente"];?></h3></a><br><h3 class="testoVendita"> riguardo all'annuncio <?php echo  $row['annuncio']?></h3>
                        <p class="center">vorrebbe comprare <?php echo $row["nome"];?><br>al prezzo di: <?php echo $row['prezzo']?>€</p>
                        <p><a href="biciclettaVenduta.php?ID=<?php echo $row['bici'];?>&ACQ=<?php echo $row["utente"];?>&PREZ=<?php echo $row['prezzo']?>&annuncio=<?php echo  $row['annuncio']?>" class="btn btn-primary margbotton" role="button">Accettta! vendi</a>
                            <a href="rifiutaAcquisto.php?annuncio=<?php echo $row['annuncio'];?>&utente=<?php echo $row['utente'];?>" class="btn btn-default margbotton" role="button">rifiuta</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
?>
</div>
</body>
</html>
