<?php
include 'header.php';

?>
    <body style="background: mediumspringgreen"></body>
<?php

sec_session_start();
//controllo se sei loggato
if(login_check($mysqli) == true) {

//controllo se sei nel tuo profilo
    if(isset($_GET['profilo'])!=true || $_GET['profilo']==$_SESSION['nikname']) {



        $nickname = $_SESSION['nikname'];


        echo '<h1 style="text-align: center">Sei nel tuo profilo</h1>';
        echo '<br>';

     //prendo da data base le info
        $query = "SELECT * FROM informazioni JOIN utente ON informazioni.nickname=utente.nickname
                 WHERE informazioni.nickname = '$nickname'";
        $result = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
     //conto gli amici
        $Qamici = "SELECT COUNT(*) as numeroAmici FROM `segue` WHERE (utente='$nickname' AND approvato=1) OR
                   (seguitoDa='$nickname' AND approvato=1)";
        $resultAmici = mysqli_query($mysqli, $Qamici);
        $rowAmici = mysqli_fetch_array($resultAmici, MYSQLI_ASSOC);

        //info
            ?>
            <div class=" ">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" style="border-radius: 30px; ">
                        <img <?php if ($row['sesso'] == 0){ ?>src="img/girllogo.svg"
                             style="width: 100px;margin-top: 44px" <?php } else ?> src="img/manlogo.svg"
                             style="width: 100px;margin-top: 44px" alt="vvvv">
                        <div class="caption">
                            <h3 style="text-align: center"><?php echo $row["nickname"];
                            echo "<br>"; echo $row['email']; ?></h3>
                            <p style="text-align: center">L'Utente <?php echo $row["nome"],' ' ,$row['cognome'];
                                echo "<br>";
                                echo 'Nato il ';
                                echo $row['dataNascita'];
                                echo ' a ';
                                echo $row['luogoNascita'];
                                echo "<br>";?> Vive a <?php echo $row["residenza"];

                                if ($row['esperienza'] == 0) {
                                    echo ', è un esperto';
                                } else echo ', è un principiante';
                                ?> </p>
                            <p style="color: #4CAF50;text-align: center">Hai <?php echo $rowAmici['numeroAmici'];?> amici</p>
                            <p><a style="margin-left: 85px" href="info.php" class="btn btn-primary" role="button">Modifica il tuo profilo</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6 col-md-4" >
                    <div class="thumbnail" style="border-radius: 30px; background-color: coral">
                        <img src="img/garage.svg" style=" border-radius: 45px" alt="vvvv">
                        <div class="caption">
                            <h3>Garage</h3>
                            <p><a  href="garage.php?nickname=<?php echo $row["nickname"]; ?>" class="btn btn-primary"
                                  role="button">visita il tuo garage, <?php echo $row['nome']; ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php

          //uscite organizzato
  echo '<h1 style="text-align: center">Uscite organizzate da te</h1>';
            $queryU = "SELECT * FROM uscita WHERE organizzatore='$nickname'ORDER BY ID DESC";
            $resultU = mysqli_query($mysqli, $queryU);

            while ($rowU = mysqli_fetch_array($resultU, MYSQLI_ASSOC)){

            ?>
            <div class=" ">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" style="border-radius: 80px;background-color: gold; height: 730px">

                        <img <?php if ($rowU['tipologia'] == 0){ ?>src="img/uscitaMount%202.jpg" style="border-radius: 80px;width: 400px;height: 200px" <?php } else ?>
                             src="img/uscitaCorsa%202.jpg" style="border-radius: 80px;width: 400px;height: 200px";
                             alt="vvvv" >
                        <div class="caption">
                            <h3 style="text-align: center"><?php echo $rowU["titolo"]; ?></h3>
                            <p style="text-align: center">é un'uscita per Bike da <?php if ($rowU["tipologia"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di livello <?php echo $rowU["difficolta"]; ?> <br>
                                organizata da <?php echo $rowU["organizzatore"]; ?><br> pedaleremo per <?php echo $rowU["distanza"]; ?> km, con un
                                dislivello di <?php echo $rowU["dislivello"]; ?>m.<br>
                                L'incontro si terra il <?php echo $rowU["dataIncontro"]; ?><br> a <?php echo $rowU["luogo"]; ?><br> alle <?php echo $rowU["oraIncontro"]; ?>
                              </p>
                            <p style="color: #4CAF50; text-align: center">NOTE: <?php echo $rowU["note"]; ?></p>
                           <?php

                           $distanzaUscita= $rowU["distanza"];
                     //controllo se la somma delle tappe e la distanza dell'uscita coincidono
                           $uscita=$rowU['ID'];
                           $queryLunghezza="SELECT SUM(lunghezza) as somma FROM tappa WHERE uscita=$uscita";
                           $resultLunghezza = mysqli_query($mysqli, $queryLunghezza);
                           $rowLunghezza = mysqli_fetch_array($resultLunghezza, MYSQLI_ASSOC);
                           $somma=$rowLunghezza['somma'];

                           if ($distanzaUscita==$somma){
                               echo '<p><a style="color: springgreen; width: 100%; border-radius: 30px" href="tappe.php?uscita='.$uscita.' " class="btn btn-primary"
                                     role="button">VISUALIZZA TAPPE</a>
                               </p>';
                           }else{
                               echo '<p><a style="color: red; width: 100%; border-radius: 30px" href="tappe.php?uscita='.$uscita.' " class="btn btn-primary"
                                     role="button">INSERISCI TAPPE e Pubblica</a>
                               </p>';
                           }


                       //controllo se l'uscita è conclusa
                           $queryfine = "SELECT * FROM uscita WHERE organizzatore='$nickname'&& ID=$uscita";
                           $resultfine = mysqli_query($mysqli, $queryfine);
                           $rowfine = mysqli_fetch_array($resultfine, MYSQLI_ASSOC);


                           if($rowfine['fine']!=null){
                              //se l'uscita è terminata mostra valutazioni
                               ?>

                               <p><a style="color: green; width: 100%; border-radius: 30px" href="visualizzaValutazioni.php?uscita=<?php echo $uscita ?>" class="btn btn-primary"
                                   role="button">VISUALIZZA VALUTAZIONI</a>
                            </p>
                              <?php
                           } else {
                               $visibilita=$rowfine['visibile'];
                               //eltrimenti tasto concludi
                           ?>
                            <p ><a style="color: red; width: 100%; border-radius: 30px" href="terminaUscita.php?uscita=<?php echo $uscita ?>" class="btn btn-primary"
                                   role="button">CONCLUDI USCITA</a>
                            </p>
                               <form action="modificaVisibilita.php" method="post" style="align-content: center">
                                   <input type="hidden" value="<?php echo $uscita ?>" name="uscita" ><br>
                                   VISIBILITà: <label class="radio-inline">
                                       <?php if($visibilita == 0){
                                           //cambio visibilità
                                       ?>
                                       <input type="radio" name="visibile" id="inlineRadio1" value=0 checked> pubblica
                                   </label>
                                   <label class="radio-inline">
                                       <input type="radio" name="visibile" id="inlineRadio2" value=1> privata
                                   </label><br>
                                   <?php

                                   }else{
                                       ?>
                                       <input type="radio" name="visibile" id="inlineRadio1" value=0 > pubblica
                                       </label>
                                       <label class="radio-inline">
                                           <input type="radio" name="visibile" id="inlineRadio2" value=1 checked> privata
                                       </label><br>


                                       <?php

                                   }
                                   ?>
                                   <input style="background: red; width: 100%; border-radius: 30px" type="submit" value="cambia VISIBILITà">
                               </form>

                            <?php

                            $queryConto = "SELECT COUNT(*) as conto FROM partecipa WHERE uscita =$uscita";
                            $resultConto = mysqli_query($mysqli, $queryConto);
                            $rowConto = mysqli_fetch_array($resultConto, MYSQLI_ASSOC);
                            ?>
                            <p style="text-align: center; color: green; font-weight: bolder">
                                all'uscita sono iscritti <?php echo $rowConto["conto"]; ?> utenti
                            </p>

                            <?php

                            $queryPartecipa = "SELECT * FROM partecipa WHERE utente='$nickname'&& uscita =$uscita";
                            $resultPartecipa = mysqli_query($mysqli, $queryPartecipa);
                            $rowPartecipa = mysqli_fetch_array($resultPartecipa, MYSQLI_ASSOC);

                            if($rowPartecipa['utente']==$nickname){


                                ?>
                                <p> <a style="width: 100%; border-radius: 30px" href="visualizzaUscite.php" class="btn btn-primary" role="button" >SEI GIà ISCRITTO</a></p>

                                <?php

                            }else{

                            ?>
                            <p><a style="width: 100%; border-radius: 30px" href="interno.php?ID=<?php echo $rowU['ID']; ?>
                            &tipologia=<?php echo $rowU['tipologia']; ?>" class="btn btn-primary" role="button">PARTECIPA!</a></p>
                                <?php }

                                }
                                ?>
                            <p><a style="width: 70%; border-radius: 30px;color: red; margin-left: 50px" href="eliminaUscita.php?ID=<?php echo $rowU['ID']; ?>
                            &tipologia=<?php echo $rowU['tipologia']; ?>" class="btn btn-primary" role="button">ELIMINA USCITA</a></p>

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
        $utente1 = $_GET['profilo'];
        $utente2 = $_SESSION['nikname'];

        $queryesiste = "SELECT count(*) AS conto FROM utente WHERE nickname='$utente1'";
        $resultesiste = mysqli_query($mysqli, $queryesiste);
        $rowesiste = mysqli_fetch_array($resultesiste, MYSQLI_ASSOC);

        if ($rowesiste['conto'] >= 1){

            $amici = "SELECT count(*) as amici, data FROM segue WHERE ((utente='$utente1' && seguitoDa='$utente2') || (utente='$utente2' && seguitoDa='$utente1')) && approvato=1 ";
        $amicizia = mysqli_query($mysqli, $amici);
        $follow = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);


        if ($follow['amici'] != 0) {

            $nickname = $_GET['profilo'];
            $data = $follow['data'];
            echo '<h1 style="text-align: center">Sei nel profilo di ' . $nickname . '<br></h1>';
            echo '<h3 style="text-align: center">siete amici dal ' . $data . '</h3>';


            $query = "SELECT * FROM informazioni join utente ON informazioni.nickname=utente.nickname
                 WHERE utente.nickname = '$nickname'";
            $result = mysqli_query($mysqli, $query);

            $Qamici = "SELECT COUNT(*) as numeroAmici FROM `segue` WHERE (utente='$nickname' AND approvato=1) OR
                   (seguitoDa='$nickname' AND approvato=1)";
            $resultAmici = mysqli_query($mysqli, $Qamici);
            $rowAmici = mysqli_fetch_array($resultAmici, MYSQLI_ASSOC);


            $row = mysqli_fetch_array($result, MYSQLI_ASSOC)

            ?>
            <div class=" ">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" style="border-radius: 30px; ">
                        <img <?php if ($row['sesso'] == 0){ ?>src="img/girllogo.svg"
                             style="width: 100px;margin-top: 44px" <?php } else ?> src="img/manlogo.svg"
                             style="width: 100px;margin-top: 44px" alt="vvvv">
                        <div class="caption">
                            <h3 style="text-align: center"><?php echo $row["nickname"];
                                echo "<br>"; echo $row['email']; ?></h3>
                            <p style="text-align: center">L'Utente <?php echo $row["nome"], ' ', $row['cognome'];
                                echo "<br>";
                                echo 'Nato il ';
                                echo $row['dataNascita'];
                                echo ' a ';
                                echo $row['luogoNascita'];
                                echo "<br>"; ?> Vive a <?php echo $row["residenza"];

                                if ($row['esperienza'] == 0) {
                                    echo ', è un esperto';
                                } else echo ', è un principiante';
                                ?> </p>
                            <p style="text-align: center;color: #4CAF50">l'utente
                                ha <?php echo $rowAmici['numeroAmici']; ?> amici
                            </p><?php
            $top = "SELECT COUNT(*) as contoPersonale FROM `segue` WHERE (utente='$nickname' AND approvato=1) OR
                                            (seguitoDa='$nickname' AND approvato=1)";
            $toplocal = mysqli_query($mysqli, $top);
            $rowtoplocal = mysqli_fetch_array($toplocal, MYSQLI_ASSOC);
            $amiciconto=$rowtoplocal['contoPersonale'];

            $utt = "SELECT COUNT(*) as contoutenti FROM utente ";
            $contotots = mysqli_query($mysqli, $utt);
            $rowutente = mysqli_fetch_array($contotots, MYSQLI_ASSOC);
            $numeroUtenti=$rowutente['contoutenti'];


            if($amiciconto>($numeroUtenti*1/5)){?>
                <p>top local friendzzzzz<?php echo $amiciconto; echo  $numeroUtenti;?></p>
                           <?php }else{echo '';} ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" style="border-radius: 30px;background-color: coral">
                        <img src="img/garage.svg" style="border-radius: 30px" alt="vvvv">
                        <div class="caption">
                            <h3>Garage</h3>
                            <p><a href="garage.php?nickname=<?php echo $row["nickname"]; ?>" class="btn btn-primary"
                                  role="button">visita il garage di <?php echo $row['nome']; ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            $queryU = "SELECT * FROM uscita WHERE organizzatore='$nickname' and nascosto=1";
            $resultU = mysqli_query($mysqli, $queryU);
            echo '<h1 style="text-align: center"> Uscite organizzate dall utente</h1>';
            while ($rowU = mysqli_fetch_array($resultU, MYSQLI_ASSOC)) {

                ?>

                <div class=" ">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" style="border-radius: 80px ; background-color: gold;height: 572px">

                            <img <?php if ($rowU['tipologia'] == 0){ ?>src="img/uscitaMount%202.jpg"
                                 style="border-radius: 80px;width: 400px;height: 200px"<?php } else ?>
                                 src="img/uscitaCorsa%202.jpg" style="border-radius: 80px;width: 400px;height: 200px"
                                 alt="vvvv">
                            <div class="caption">
                                <h3 style="text-align: center"><?php echo $rowU["titolo"]; ?></h3>
                                <p style="text-align: center">é un'uscita per Bike
                                    da <?php if ($rowU["tipologia"] == 0) {
                                        echo 'mountain';
                                    } else {
                                        echo 'corsa';
                                    } ?>, di livello <?php echo $rowU["difficolta"]; ?> <br>
                                    organizata da <?php echo $rowU["organizzatore"]; ?><br> pedaleremo
                                    per <?php echo $rowU["distanza"]; ?> km, con un
                                    dislivello di <?php echo $rowU["dislivello"]; ?>m.<br>
                                    L'incontro si terra il <?php echo $rowU["dataIncontro"]; ?>
                                    a <?php echo $rowU["luogo"]; ?><br> alle <?php echo $rowU["oraIncontro"]; ?>
                                </p>
                                <p style="color: #4CAF50; text-align: center">NOTE: <?php echo $rowU["note"]; ?></p>

                                <p style="text-align: center">         <?php

                                    if ($rowU['visibile'] == 0) {
                                        echo 'uscita PUBBLICA';
                                    } else {

                                        echo 'uscita PRIVATA';
                                    } ?>
                                </p>

                                <?php
                                $uscita = $rowU['ID'];
                                $queryConto = "SELECT COUNT(*) as conto FROM partecipa WHERE uscita =$uscita";
                                $resultConto = mysqli_query($mysqli, $queryConto);
                                $rowConto = mysqli_fetch_array($resultConto, MYSQLI_ASSOC);
                                ?>
                                <p style="text-align: center; color: green; font-weight: bolder">
                                    all'uscita sono iscritti <?php echo $rowConto["conto"]; ?> utenti
                                </p>

                                <?php
                                echo '<p><a style="color: springgreen; width: 100%"; border-radius: 30px href="tappe.php?uscita=' . $uscita . ' " class="btn btn-primary"
                                     role="button">VISUALIZZA TAPPE</a>
                               </p>';

                                $queryPartecipa = "SELECT * FROM partecipa WHERE utente='$utente2'&& uscita =$uscita";
                                $resultPartecipa = mysqli_query($mysqli, $queryPartecipa);
                                $rowPartecipa = mysqli_fetch_array($resultPartecipa, MYSQLI_ASSOC);
                                if($rowU['fine']==1){
                                   ?> <a style="width: 100%; border-bottom-left-radius: 100px;border-bottom-right-radius: 100px; color: red" href="visualizzaUscite.php" class="btn btn-primary"
                                       role="button">USCITA CONCLUSA</a>
                                    <?php
                                } else{
                                if ($rowPartecipa['utente'] == $utente2){


                                    ?>
                                    <a style="width: 100%; border-bottom-left-radius: 100px;border-bottom-right-radius: 100px; color: red" href="visualizzaUscite.php" class="btn btn-primary"
                                       role="button">sei gia iscritto</a>

                                    <?php

                                }else{

                                ?>
                                <p>
                                    <a style="width: 100%; border-bottom-left-radius: 100px;border-bottom-right-radius: 100px"
                                       href="interno.php?ID=<?php echo $rowU['ID']; ?>
                            &tipologia=<?php echo $rowU['tipologia']; ?>" class="btn btn-primary" role="button">PARTECIPA!</a>
                                    <?php

                                    } } ?>

                            </div>
                        </div>
                    </div>
                </div>


                <?php
            }


        } else {

            $seguace = "SELECT approvato as seguace FROM segue WHERE ((utente='$utente1' && seguitoDa='$utente2') || (utente='$utente2' && seguitoDa='$utente1'))";
            $amicizia = mysqli_query($mysqli, $seguace);
            $follow1 = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);
            $profilo = $_GET['profilo'];

            if (isset($follow1['seguace']) != true) {
                echo 'aggiungi ';
                echo $_GET['profilo'];
                ?>  <a href="richiestaAmicizia.php?profilo=<?php echo $profilo; ?>" class="btn btn-primary"
                       role="button">invia richiesta</a>

                <?php
            } else {
                echo 'richiesta inviata a ';
                echo $_GET['profilo'];
                ?>
                <a href="richiestaAmicizia.php?profilo=<?php echo $profilo; ?>" class="btn btn-primary" role="button">attesa</a>
                <?php


            }


        } }else{echo '<h1 style="color: red">utente non trovato</h1>';}


    }






} else {

    echo 'accedi';?>  <a href="login.php">Login</a><?php
}