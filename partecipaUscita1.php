<?php
include 'header.php';

?>
    <body style="background: coral"></body>
<?php

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
        $numerobici = mysqli_query($mysqli, $conto);
        $stampa = mysqli_fetch_array($numerobici, MYSQLI_ASSOC);


        echo "<br>";
        echo "puoi scegliere tra ";
        echo $stampa['totale'];
        echo " biciclette";
        echo "<br>";
        echo "<br>";


        $query = "SELECT * FROM bicicletta WHERE proprietario = '$nickname'&&tipo=$tipologia ";
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

                        <img <?php if ($row['tipo'] == 0){ ?>src="img/mountainVera%202.jpg"style="border-radius: 80px;
                       margin-top: 5px;margin-left: auto;background-color: white"<?php }
                       else ?> src="img/corsaVera%202.jpg"style="border-radius: 80px;
                       margin-top: 5px;margin-left: auto;background-color: white";
                             alt="vvvv">
                        <div class="caption">
                            <h3 style="text-align: center"><?php echo $row["nome"]; ?></h3>
                            <p style="text-align: center">Bike da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di colore <?php echo $row["colore"]; ?> <br>
                                Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br></p>
                            <p><a style="margin-left: 31px" href="partecipaUscita2.php?ID=<?php echo $uscita; ?>&bike=<?php echo $row['ID']; ?>&partecipante=<?php echo $nickname ?>" class="btn btn-primary" role="button">USA questa BIKE!!!!</a>


                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }




}

else {

    echo accedi;?>  <a href="login.php">Login</a><?php
}



