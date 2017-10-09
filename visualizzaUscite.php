<?php
include 'header.php';

?>

<?php

sec_session_start();
if(login_check($mysqli) == true) {
    $nickname =$_SESSION['nikname'];


    $best="SELECT organizzatore,COUNT(*) as conto from uscita WHERE difficolta=2 AND visibile=0 AND
           (dataIncontro BETWEEN DATE_SUB(CURRENT_DATE,INTERVAL 1 month) AND CURRENT_DATE) group by organizzatore 
           HAVING COUNT(*)>=ALL(SELECT COUNT(*)FROM uscita WHERE difficolta=2 AND visibile=0 AND 
           (dataIncontro BETWEEN DATE_SUB(CURRENT_DATE,INTERVAL 1 month) AND CURRENT_DATE)GROUP by organizzatore)";
    $mysqli->query($best)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $risultatobest=mysqli_query($mysqli, $best);
    $bestorganizzatore=mysqli_fetch_array($risultatobest,MYSQLI_ASSOC);
    $nomeorg=$bestorganizzatore['organizzatore'];
    $numerorg=$bestorganizzatore['conto'];

    echo 'BEST ORGANIZZATORE DEL MESE: ';?>
    <a href="profilo.php?profilo=<?php echo $nomeorg;?>"><?php echo $nomeorg;?></a>;<br>


   <?php

    echo 'BEST PARTECIPANTI: ';
    $part="SELECT utente,COUNT(DISTINCT bicicletta) from partecipa join uscita ON uscita.ID=partecipa.uscita
     WHERE uscita.visibile=0 GROUP BY partecipa.utente HAVING COUNT(DISTINCT bicicletta)=
     (SELECT COUNT(*) from bicicletta WHERE bicicletta.proprietario=partecipa.utente group BY bicicletta.proprietario)";
    $mysqli->query($part)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $risultatopart=mysqli_query($mysqli, $part);
    while ($parecipantibest=mysqli_fetch_array($risultatopart,MYSQLI_ASSOC)){?>
        <a href="profilo.php?profilo=<?php echo $parecipantibest['utente'];?>"><?php echo $parecipantibest['utente'];?></a>;<?php

        }
      ?>

   <br> <a href="creauscita.php" class="center">Crea una nuova Uscita</a><br>
           <br>

    <form action="filtraUscite.php" method="get">
           <div class="thumbnail usciteth">
    <label> filtra uscite </label>


           <select name="tipologia" >
        <option value="" disabled selected>tipologia </option>
        <option value=0 >mountain</option>
        <option value=1 >corsa</option>
    </select>

    <select name="difficolta" >
        <option value="" disabled selected>difficolta</option>
        <option value=1  >facile</option>
        <option value=2 >media</option>
        <option value=3 >difficile</option>
    </select>

    <select name="distanza" >
        <option value="" disabled selected>distanza max</option>
        <option value=20 >20</option>
        <option value=40 >40</option>
        <option value=70 >70</option>
        <option value=100 >100</option>
        <option value=150 >150</option>
    </select>
           <input class="sublog" type="submit" value="CERCA">
               <input class="sublog orange" type="submit" value="elimina filtri">
           </div>
    </form>







    <?php
    $prova="select query ,testo from filtrouscite where nickname='$nickname'";
    $mysqli->query($prova)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $risultatoprova=mysqli_query($mysqli, $prova);
    $provaprova=mysqli_fetch_array($risultatoprova,MYSQLI_ASSOC);
    $definitiva=$provaprova['query'];
    $testo=$provaprova['testo'];

    if(empty(trim($definitiva))){echo ' ';}
    else{
        echo "<h3>filtro inserito:$testo</h3>";}

    ?> <h1 class="center">Uscite</h1><?php


    $queryVis = "SELECT * FROM `uscita` WHERE nascosto=1 AND $definitiva  ID NOT in (SELECT ID from uscita where fine = 1) 
        AND( organizzatore='$nickname' OR visibile=0 or (organizzatore IN(SELECT seguitoDa FROM segue WHERE utente='$nickname'AND
            approvato=1)OR organizzatore IN(SELECT utente FROM segue WHERE seguitoDa='$nickname'AND approvato=1)))
             ORDER BY dataIncontro ";
    $mysqli->query($queryVis)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
            $resultVis = mysqli_query($mysqli, $queryVis);

            while ($rowVis = mysqli_fetch_array($resultVis, MYSQLI_ASSOC)) {



            ?>
            <div class=" ">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail rad80 uscitethumb">

                        <?php if ($rowVis['tipologia'] == 0){ ?>
                            <img class="usciteimm" src="img/uscitaMount%202.jpg"
                                 alt="vvvv"><?php }?>

                        <?php if ($rowVis['tipologia'] == 1){ ?>
                            <img class="usciteimm" src="img/uscitaCorsa%202.jpg"
                                 alt="vvvv"><?php }?>


                        <div class="caption">
                            <h3 class="center"><?php echo $rowVis["titolo"]; ?></h3>
                            <p class="center">un'uscita per Bike da <?php if ($rowVis["tipologia"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>,<br> di livello <?php echo $rowVis["difficolta"]; ?> <br>
                                organizata da <?php echo $rowVis["organizzatore"]; ?><br> pedaleremo per <?php echo $rowVis["distanza"]; ?> km, con un
                                dislivello di <?php echo $rowVis["dislivello"]; ?>m.<br>
                                L'incontro si terra il <?php echo $rowVis["dataIncontro"]; ?><br> a <?php echo $rowVis["luogo"]; ?><br> alle <?php echo $rowVis["oraIncontro"]; ?>
                              </p>
                            <p class="center" style="color: #4CAF50">NOTE: <?php echo $rowVis["note"]; ?></p>

                 <p class="center">         <?php
                            $uscita=$rowVis['ID'];

                            if($rowVis['visibile']==0){
                                echo 'uscita PUBBLICA';
                            } else{

                                echo 'uscita PRIVATA';
                            } ?>
                 </p>
                            <p><a class="btn btn-primary visTap" href="tappe.php?uscita=<?php echo $uscita;?>"
                                  role="button">VISUALIZZA TAPPE</a>
                            </p>
        <?php
          $uscita=$rowVis['ID'];
          $queryConto = "SELECT COUNT(*) as conto FROM partecipa WHERE uscita =$uscita";
        $mysqli->query($queryConto)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
          $resultConto = mysqli_query($mysqli, $queryConto);
          $rowConto = mysqli_fetch_array($resultConto, MYSQLI_ASSOC);
        ?>
                            <p class="center" style="color: green;">
                                all'uscita sono iscritti <?php echo $rowConto["conto"]; ?> utenti
                            </p>

            <?php

          $queryPartecipa = "SELECT * FROM partecipa JOIN bicicletta ON bicicletta.ID=partecipa.bicicletta
                             WHERE utente='$nickname'&& uscita =$uscita";
            $mysqli->query($queryPartecipa)
            or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
          $resultPartecipa = mysqli_query($mysqli, $queryPartecipa);
          $rowPartecipa = mysqli_fetch_array($resultPartecipa, MYSQLI_ASSOC);

          if($rowPartecipa['utente']==$nickname){


              ?>
              <p><a class="btn btn-primary tastoBassoUscite" style="color: red" role="button" >ISCRITTO con <?php echo $rowPartecipa['nome']?></a>

              <?php

            }else{

          ?>
                            <p><a class="btn btn-primary tastoBassoUscite"
                               href="interno.php?ID=<?php echo $rowVis['ID'];?>&tipologia=<?php echo $rowVis['tipologia']; ?>" role="button">PARTECIPA!</a>
                                <?php

                                }     ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }
//}
else {

    echo "accedi";?>  <a href="login.php">Login</a><?php
}

?>
</div>
</body>
</html>
