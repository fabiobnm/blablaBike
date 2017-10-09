<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    if(isset($_GET['nickname'])!=true ||  $_GET['nickname']==$_SESSION["nikname"]) {
        $nickname = $_SESSION["nikname"];

        ?>
        <h1 class="center">GARAGE</h1><br>
        <a href="sceltaInsert.php" class="sottot">Inserisci una nuova Bike in Garage</a>
        <?php

        $conto = "SELECT count(*) as totale FROM bicicletta WHERE proprietario='$nickname'";
        $mysqli->query($conto)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $numerobici = mysqli_query($mysqli, $conto);
        $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "<h3 class='center'>Hai ";
        echo $stampa['totale'];
        echo " biciclette</h3>";
        echo "<br>";
        echo "<br>";


        $query = "SELECT * FROM bicicletta LEFT OUTER JOIN annuncio ON bicicletta.ID=annuncio.bicicletta WHERE proprietario='$nickname'";
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
                    <div class="thumbnail thgarage">

                        <?php if ($row['tipo'] == 0){ ?>
                            <img class="immvere" src="img/mountainVera%202.jpg"
                                 alt="vvvv"><?php }?>

                        <?php if ($row['tipo'] == 1){ ?>
                            <img class="immvere" src="img/corsaVera%202.jpg"
                                 alt="vvvv"><?php }?>



                        <div class="caption">
                            <h3 class="center"><?php echo $row["nome"]; ?></h3>
                            <p class="center">Bike da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di colore <?php echo $row["colore"]; ?> <br>
                                di Marca  <?php echo $row["marca"]; ?><br>
                                e Modello  <?php echo $row["modello"]; ?>
                                Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br>
                                  <?php if($row['tipo']==0){?>ha ruote da <?php echo $row['ruote'];}
                                  else {?>pesa <?php echo $row['peso'];
                                  echo ' Kg';}?> </p>
                            <p><a  class="btn btn-primary tastgar" href="eliminaBike.php?ID=<?php echo $row['ID']; ?>" role="button">elimina</a> <a
                                        href="newmodificabike.php?ID=<?php echo $row['ID']; ?>&tipo=<?php echo $row['tipo']; ?>" class="btn btn-default" role="button">modifica</a>
       <?php
          /*  $bike=$row['ID'];
            $vendita="SELECT COUNT(*) as conto FROM annuncio 
                       WHERE bicicletta = $bike ";
       $mysqli->query($vendita)
       or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
            $inVendita = mysqli_query($mysqli, $vendita);
            $sale = mysqli_fetch_array($inVendita, MYSQLI_ASSOC);*/

            if ($row['IDannuncio']!=null){

            ?> <a href="mercatino.php?ID=<?php echo $row['ID']; ?>" class="btn btn-default" role="button">in vendita</a>
            <?php

        } else {?>

                <a href="creaAnnuncio.php?ID=<?php echo $row['ID']; ?>" class="btn btn-default" role="button">vendi</a></p>
          <?php  }

        ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }   else{
        $utente1=$_GET['nickname'];
        $utente2=$_SESSION['nikname'];
        $amici="SELECT count(*) as amici FROM segue WHERE ((utente='$utente1' && seguitoDa='$utente2') || (utente='$utente2' && seguitoDa='$utente1')) && approvato=1 ";
        $mysqli->query($amici)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $amicizia = mysqli_query($mysqli, $amici);
        $follow = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);

        if($follow['amici']!=0){

        $nickname=$_GET['nickname'];
        echo '<h1>sei nel garage di '.$nickname.'</h1>';


    $conto = "SELECT count(*) as totale FROM bicicletta WHERE proprietario='$nickname'";
            $mysqli->query($conto)
            or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $numerobici = mysqli_query($mysqli, $conto);
    $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "$nickname ha ";
        echo $stampa['totale'];
        echo " biciclette";
        echo "<br>";
        echo "<br>";


        $query="SELECT * FROM bicicletta LEFT OUTER JOIN annuncio ON bicicletta.ID=annuncio.bicicletta WHERE proprietario='$nickname' ";
            $mysqli->query($query)
            or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $result=mysqli_query($mysqli,$query);


        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

            ?> <div class=" ">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail thvistagar">

                        <?php if ($row['tipo'] == 0){ ?>
                            <img class="immvere" src="img/mountainVera%202.jpg"
                                 alt="vvvv"><?php }?>

                        <?php if ($row['tipo'] == 1){ ?>
                            <img class="immvere" src="img/corsaVera%202.jpg"
                                 alt="vvvv"><?php }?>

                        <div class="caption">
                            <h3 class="center"><?php echo $row["nome"]; ?></h3>
                            <p class="center">Bike da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di colore <?php echo $row["colore"]; ?> <br>
                                Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br>
                            MARCA:<?php echo $row['marca']; ?><br>
                            MODELLO:<?php echo $row["modello"]; ?></p>

                            <p>
      <?php /*
            $bike=$row['ID'];
            $vendita="SELECT COUNT(*) as conto FROM annuncio
            WHERE bicicletta = $bike ";
      $mysqli->query($vendita)
      or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
            $inVendita = mysqli_query($mysqli, $vendita);
            $sale = mysqli_fetch_array($inVendita, MYSQLI_ASSOC);*/

            if ($row['IDannuncio']!=null){

            ?> <a href="mercatino.php?ID=<?php echo $row['ID']; ?>" class="btn btn-default compra" role="button">Comprala è in vendita</a>
            <?php

        }

            ?>

            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
         }}
          else {

            echo $utente2;
            echo "<br>tu e ";
            echo $utente1;
            echo ' non sieti amici <br>';
              echo 'cercalo nella tua pagina utente e Richiedi amicizia ';




          }}




             }

else {

    echo "accedi";?>  <a href="login.php">Login</a><?php
}
?>
</div>
</body>
</html>



