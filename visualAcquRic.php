<?php
include 'header.php';

?>
    <body style="background: gold"></body>
<?php

sec_session_start();
if(login_check($mysqli) == true) {

    $nickname=$_SESSION['nikname'];
    $query="SELECT utente, annuncio, annuncio.bicicletta as bici, bicicletta.nome from richiestaacquisto join annuncio on IDannuncio= richiestaacquisto.annuncio
            JOIN bicicletta ON bicicletta.ID=annuncio.bicicletta
            where annuncio in 
            (SELECT IDannuncio from annuncio where venditore='$nickname')";
    $result=mysqli_query($mysqli,$query);

    echo '<h3 style="text-align: center">Richieste dal Mercatino</h3>';
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

        ?> <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">

                    <img src="img/richiestaacquisto.svg"  alt="vvvv">
                    <div class="caption">
                        <a href="profilo.php?profilo=<?php echo $row["utente"];?>"><h3><?php echo $row["utente"];?></h3></a><br><h3> riguardo all'annuncio <?php echo  $row['annuncio']?></h3>
                        <p>vorrebbe comprare <?php echo $row["nome"];?></p>
                        <p><a href="biciclettaVenduta.php?ID=<?php echo $row['bici']; ?>" class="btn btn-primary" role="button">Accetta! vendi</a>
                            <a href="rifiutaAcquisto.php?annuncio=<?php echo $row['annuncio'];?>&utente=<?php echo $row['utente'];?>" class="btn btn-default" role="button">rifiuta</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}