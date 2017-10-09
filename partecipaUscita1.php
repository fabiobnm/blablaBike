<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    if(isset($_GET['nickname'])!=true ||  $_GET['nickname']==$_SESSION["nikname"]) {
        $nickname = $_SESSION["nikname"];
        $tipologia=$_SESSION['tipoUscita'];
        $uscita=$_SESSION['IDuscita'];

        ?>



        <h1>uscita</h1>
        <h3>scegli la bike con cui vuoi partecipare all'uscita <?php echo $uscita?></h3>
        <?php

        $conto = "SELECT count(*) as totale FROM bicicletta WHERE proprietario='$nickname' && tipo=$tipologia";
        $mysqli->query($conto)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $numerobici = mysqli_query($mysqli, $conto);
        $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "puoi scegliere tra ";
        echo $stampa['totale'];
        echo " biciclette";
        echo "<br>";
        echo "<br>";


        $query = "SELECT * FROM bicicletta WHERE proprietario = '$nickname'&&tipo=$tipologia ";
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
                    <div class="thumbnail" style="border-radius: 30px">

                        <?php if ($row['tipo'] == 0){ ?>
                            <img class="partecipa" src="img/mountainVera%202.jpg"
                                 alt="vvvv"><?php }?>

                        <?php if ($row['tipo'] == 1){ ?>
                            <img  class="partecipa" src="img/corsaVera%202.jpg"
                                 alt="vvvv"><?php }?>

                        <div class="caption">
                            <h3 class="center"><?php echo $row["nome"]; ?></h3>
                            <p class="center">Bike da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di colore <?php echo $row["colore"]; ?> <br>
                                Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br></p>
                            <p><a href="partecipaUscita2.php?ID=<?php echo $uscita; ?>&bike=<?php echo $row['ID']; ?>&partecipante=<?php echo $nickname ?>" class="btn btn-primary marg" role="button">USA questa BIKE!!!!</a>


                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }




}

else {

    echo 'accedi';?>  <a href="login.php">Login</a><?php
}


?>
</div>
</body>
</html>

