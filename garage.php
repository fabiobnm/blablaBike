<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    if(isset($_GET['nickname'])!=true ||  $_GET['nickname']==$_SESSION["nikname"]) {
        $nickname = $_SESSION["nikname"];

        ?>
        <h1>GARAGE</h1>
        <a href="insertbike.php">Inserisci una nuova Bike in Garage</a>
        <?php

        $conto = "SELECT count(*) as totale FROM bicicletta WHERE proprietario='$nickname'";
        $numerobici = mysqli_query($mysqli, $conto);
        $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "Hai ";
        echo $stampa['totale'];
        echo " biciclette";
        echo "<br>";
        echo "<br>";


        $query = "SELECT * FROM bicicletta WHERE proprietario = '$nickname' ";
        $result = mysqli_query($mysqli, $query);

        if (isset($_GET['messaggio'])) {
            $messaggio = $_GET['messaggio'];
            echo " <h1>$messaggio</h1>";
        }


        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            ?>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">

                        <img <?php if ($row['tipo'] == 0){ ?>src="img/montagna.svg"<?php } else ?> src="img/strada.svg"
                             alt="vvvv">
                        <div class="caption">
                            <h3><?php echo $row["nome"]; ?></h3>
                            <p>è una bici da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?> di colore <?php echo $row["colore"]; ?> </p>
                            <p><a href="eliminaBike.php?ID=<?php echo $row['ID']; ?>" class="btn btn-primary" role="button">elimina</a> <a
                                        href="modificaBike.php" class="btn btn-default" role="button">modifica</a>
       <?php
            $bike=$row['ID'];
            $vendita="SELECT COUNT(*) as conto FROM annuncio 
                       WHERE bicicletta = $bike ";
            $inVendita = mysqli_query($mysqli, $vendita);
            $sale = mysqli_fetch_array($inVendita, MYSQLI_ASSOC);

            if ($sale['conto']>=1){

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
        $amicizia = mysqli_query($mysqli, $amici);
        $follow = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);

        if($follow['amici']!=0){

        $nickname=$_GET['nickname'];
        echo '<h1>sei nel garage di '.$nickname.'</h1>';


    $conto = "SELECT count(*) as totale FROM bicicletta WHERE proprietario='$nickname'";
    $numerobici = mysqli_query($mysqli, $conto);
    $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "$nickname ha ";
        echo $stampa['totale'];
        echo " biciclette";
        echo "<br>";
        echo "<br>";


        $query="SELECT * FROM bicicletta WHERE proprietario = '$nickname' ";
        $result=mysqli_query($mysqli,$query);


        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

            ?> <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">

                        <img <?php if($row['tipo']==0){ ?>src="img/montagna.svg"<?php } else  ?> src="img/strada.svg"   alt="vvvv">
                        <div class="caption">
                            <h3><?php echo $row["nome"]; ?></h3>
                            <p>è una bici da <?php if($row["tipo"]==0){echo 'mountain';}
                                else {echo 'corsa';}?> di colore <?php echo $row["colore"]; ?> </p>
                            <p><a href="profilo.php" class="btn btn-primary" role="button">profilo</a> <a href="utente.php" class="btn btn-default" role="button">utente</a>
      <?php
            $bike=$row['ID'];
            $vendita="SELECT COUNT(*) as conto FROM annuncio
            WHERE bicicletta = $bike ";
            $inVendita = mysqli_query($mysqli, $vendita);
            $sale = mysqli_fetch_array($inVendita, MYSQLI_ASSOC);

            if ($sale['conto']>=1){

            ?> <a href="mercatino.php?ID=<?php echo $row['ID']; ?>" class="btn btn-default" role="button">in vendita</a>
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
            echo "<br>";
            echo $utente1;
            echo 'non sieti amici richiedi amicizia';




          }}




             }

else {

    echo accedicazzo;?>  <a href="login.php">Login</a><?php
}



