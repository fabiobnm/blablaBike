<?php
include 'header.php';

?>
<?php

sec_session_start();
if(login_check($mysqli) == true) {


    if(isset($_GET['nickname'])!=true ||  $_GET['nickname']==$_SESSION["nikname"]) {
        $nickname = $_SESSION["nikname"];

        ?>
        <h1 style="text-align: center">Bike che hai Venduto</h1><br>

        <?php

        $conto = "SELECT count(*) as totale FROM biciclettevendute WHERE proprietario='$nickname'";
        $mysqli->query($conto)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $numerobici = mysqli_query($mysqli, $conto);
        $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "<h3 style='text-align: center'>Hai venduto ";
        echo $stampa['totale'];
        echo " biciclette</h3>";
        echo "<br>";
        echo "<br>";


        $query = "SELECT * FROM biciclettevendute WHERE proprietario = '$nickname' ";
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
                    <div class="thumbnail" style="border-radius: 50px;height: 390px">

                        <img style="border-radius: 50px;height: 150px" <?php if ($row['tipo'] == 0){ ?>src="img/mountainVera%202.jpg"style="width: 400px;height: 200px" <?php }
                        else ?> src="img/corsaVera%202.jpg" style="width: 400px;height: 200px";
                             alt="vvvv">
                        <div class="caption">
                            <h3 style="text-align: center"><?php echo $row["nome"]; ?></h3>
                            <p style="text-align: center">Bike da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di colore <?php echo $row["colore"]; ?> <br>
                                di Marca  <?php echo $row["marca"]; ?><br>
                                e Modello  <?php echo $row["modello"]; ?>
                                Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br>
                                <?php if($row['tipo']==0){?>ha ruote da <?php echo $row['ruote'];}
                                else {?>pesa <?php echo $row['peso'];
                                    echo ' Kg';}?>
                            <br>venduta a :<?php echo $row['acquirente']?><br> al prezzo di: <?php echo $row['prezzo']?>€
                            </p>

                            <?php  }

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

