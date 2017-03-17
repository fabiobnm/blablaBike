<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    if(isset($_GET['profilo'])!=true || $_GET['profilo']==$_SESSION['nikname']) {

        ?> <h1>profilo</h1>
        <?php

        $nickname = $_SESSION['nikname'];

        echo 'ciao ', $_SESSION['nikname'];
        echo '!!, sei nel tuo profilo';


        $query = "SELECT * FROM informazioni WHERE nickname = '$nickname'";
        $result = mysqli_query($mysqli, $query);


        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            ?>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img <?php if ($row['sesso'] == 0){ ?>src="img/girllogo.svg"
                             style="width: 100px;height: auto" <?php } else ?> src="img/manlogo.svg"
                             style="width: 100px;height: auto" alt="vvvv">
                        <div class="caption">
                            <h3><?php echo $row["nickname"]; ?></h3>
                            <p>profilo di <?php echo $row["nome"]; ?> residente a <?php echo $row["residenza"];
                                echo ' ';
                                if ($row['esperienza'] == 0) {
                                    echo 'esperto';
                                } else echo 'principiante';
                                ?> </p>
                            <p><a href="profilo.php" class="btn btn-primary" role="button">profilo</a> <a
                                        href="utente.php"
                                        class="btn btn-default"
                                        role="button">utente</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="img/garage.svg" alt="vvvv">
                        <div class="caption">
                            <h3>Garage</h3>
                            <p>profilo di <?php echo $row["nome"]; ?> residente a <?php echo $row["residenza"];
                                echo ' ';
                                if ($row['esperienza'] == 0) {
                                    echo 'esperto';
                                } else echo 'principiante';
                                ?> </p>
                            <p><a href="garage.php?nickname=<?php echo $row["nickname"]; ?>" class="btn btn-primary"
                                  role="button">visita il gage di <?php echo $row['nome']; ?></a> <a href="utente.php"
                                                                                                     class="btn btn-default"
                                                                                                     role="button">utente</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php

        }
        if (isset($_GET['messaggio'])) {
            $messaggio = $_GET['messaggio'];
            echo " <h1>$messaggio</h1>";
        }
    }   else {
        $utente1=$_GET['profilo'];
        $utente2=$_SESSION['nikname'];
        $amici="SELECT count(*) as amici FROM segue WHERE ((utente='$utente1' && seguitoDa='$utente2') || (utente='$utente2' && seguitoDa='$utente1')) && approvato=1 ";
        $amicizia = mysqli_query($mysqli, $amici);
        $follow = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);

        if($follow['amici']!=0){

            $nickname=$_GET['profilo'];
            echo '<h1>sei nel profilo di '.$nickname.'</h1>';

            $query="SELECT * FROM informazioni WHERE nickname = '$nickname'";
            $result=mysqli_query($mysqli,$query);



            while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                ?>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img <?php if ($row['sesso'] == 0){ ?>src="img/girllogo.svg"
                                 style="width: 100px;height: auto" <?php } else ?> src="img/manlogo.svg"
                                 style="width: 100px;height: auto" alt="vvvv">
                            <div class="caption">
                                <h3><?php echo $row["nickname"]; ?></h3>
                                <p>profilo di <?php echo $row["nome"]; ?> residente a <?php echo $row["residenza"];
                                    echo ' ';
                                    if ($row['esperienza'] == 0) {
                                        echo 'esperto';
                                    } else echo 'principiante';
                                    ?> </p>
                                <p><a href="profilo.php" class="btn btn-primary" role="button">profilo</a> <a
                                            href="utente.php"
                                            class="btn btn-default"
                                            role="button">utente</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="img/garage.svg" alt="vvvv">
                            <div class="caption">
                                <h3>Garage</h3>
                                <p>profilo di <?php echo $row["nome"]; ?> residente a <?php echo $row["residenza"]; echo ' '; if($row['esperienza']==0){echo 'esperto';}
                                    else echo 'principiante';
                                    ?> </p>
                                <p><a href="garage.php?nickname=<?php echo $row["nickname"]; ?>" class="btn btn-primary" role="button">visita il gage di <?php echo $row['nome'];?></a> <a href="utente.php"
                                                                                                                                                                                           class="btn btn-default"
                                                                                                                                                                                           role="button">utente</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
            }
        }

        else {

            $seguace="SELECT approvato as seguace FROM segue WHERE ((utente='$utente1' && seguitoDa='$utente2') || (utente='$utente2' && seguitoDa='$utente1'))";
            $amicizia = mysqli_query($mysqli, $seguace);
            $follow1 = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);
            $profilo= $_GET['profilo'];

            if(isset($follow1['seguace']) != true ){
                echo 'aggiungi ';echo $_GET['profilo'];
          ?>  <a href="richiestaAmicizia.php?profilo=<?php echo $profilo;?>" class="btn btn-primary" role="button">invia richiesta</a>

            <?php
            }
            else {
                echo 'richiesta inviata a ';echo $_GET['profilo'];
                  ?>
                    <a href="richiestaAmicizia.php?profilo=<?php echo $profilo;?>" class="btn btn-primary" role="button">attesa</a>
                  <?php




            }



        }

    }






} else {

    echo 'accedicazzo';?>  <a href="login.php">Login</a><?php
}