<?php
include 'header.php';

?>
    <body style="background: springgreen"></body>
<?php

sec_session_start();
if(login_check($mysqli) == true) {
    $nickname =$_SESSION['nikname'];

    if( isset($_GET['tipologia'])){}
    else{
        $prova="select testo from filtrouscite where nickname='$nickname'";
        $risultatoprova=mysqli_query($mysqli, $prova);
        $provaprova=mysqli_fetch_array($risultatoprova,MYSQLI_ASSOC);
        $definitiva=$provaprova['query'];
        $testo=$provaprova['testo'];
        if(empty(trim($testo))) {
        } else{
            header("location: /uscitaPROVAPAZZA.php?$testo");;}}



    ?>

    <a href="creauscita.php" style="text-align: center;font-weight: bolder" >Crea una nuova Uscitaaaaa</a><br>
    <br>
    <form action="filtraUscite.php" method="get">
        <div class="thumbnail" style="border-radius: 30px; background-color: gold;width: 550px">
            <label> filtra uscite </label>

      <?php ?>

          <?php $tipologia=$_GET['tipologia'];
          if($tipologia==0){?>
            <select name="tipologia" >
                <option value="" disabled selected>tipologia </option>
                <option  value=0 selected>mountain</option>
                <option value=1 >corsa</option>
            </select><?php }else if($tipologia==1){?>
             <select name="tipologia" >
                <option value="" disabled selected>tipologia </option>
                <option  value=0 >mountain</option>
                <option value=1 selected>corsa</option>
            </select><?php}?>

            <select name="difficolta" >
                <option value="" disabled selected>difficoltà</option>
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
            <input style="background: lemonchiffon;border-radius: 30px" type="submit"value="CERCA">
            <input style="background: orangered;border-radius: 30px" type="submit"value="elimina filtri">
    </form>
    </div>






    <?php
    $prova="select query ,testo from filtrouscite where nickname='$nickname'";
    $risultatoprova=mysqli_query($mysqli, $prova);
    $provaprova=mysqli_fetch_array($risultatoprova,MYSQLI_ASSOC);
    $definitiva=$provaprova['query'];
    $testo=$provaprova['testo'];

    if(empty(trim($definitiva))){echo ' ';}
    else{
        echo "<h3>filtro inserito:$testo</h3>";}

    ?> <h1 style="text-align: center">USCITE</h1><?php


    $queryVis = "SELECT * FROM `uscita` WHERE nascosto=1 AND $definitiva  ID NOT in (SELECT ID from uscita where fine = 1) 
        AND( organizzatore='$nickname' OR visibile=0 or (organizzatore IN(SELECT seguitoDa FROM segue WHERE utente='$nickname'AND
            approvato=1)OR organizzatore IN(SELECT utente FROM segue WHERE seguitoDa='$nickname'AND approvato=1)))
             ORDER BY dataIncontro ";
    $resultVis = mysqli_query($mysqli, $queryVis);

    while ($rowVis = mysqli_fetch_array($resultVis, MYSQLI_ASSOC)) {



        ?>
        <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style="border-radius: 50px; background-color: gold; height: 570px">

                    <img style="border-radius: 80px; width: 400px;height: 200px" <?php if ($rowVis['tipologia'] == 0){ ?>src="img/uscitaMount%202.jpg"<?php } else ?> src="img/uscitaCorsa%202.jpg"
                         alt="vvvv">
                    <div class="caption">
                        <h3 style="text-align: center"><?php echo $rowVis["titolo"]; ?></h3>
                        <p style="text-align: center">é un'uscita per Bike da <?php if ($rowVis["tipologia"] == 0) {
                                echo 'mountain';
                            } else {
                                echo 'corsa';
                            } ?>, di livello <?php echo $rowVis["difficolta"]; ?> <br>
                            organizata da <?php echo $rowVis["organizzatore"]; ?> pedaleremo per <?php echo $rowVis["distanza"]; ?> km, con un
                            dislivello di <?php echo $rowVis["dislivello"]; ?>.<br>
                            L'incontro si terra il <?php echo $rowVis["dataIncontro"]; ?> a <?php echo $rowVis["luogo"]; ?> alle <?php echo $rowVis["oraIncontro"]; ?>
                        </p>
                        <p style="color: #4CAF50; text-align: center">NOTE: <?php echo $rowVis["note"]; ?></p>

                        <p style="text-align: center">         <?php
                            $uscita=$rowVis['ID'];

                            if($rowVis['visibile']==0){
                                echo 'uscita PUBBLICA';
                            } else{

                                echo 'uscita PRIVATA';
                            } ?>
                        </p>
                        <p><a style="color: green; margin-left: 55px" href="tappe.php?uscita=<?php echo $uscita;?>" class="btn btn-primary"
                              role="button">VISUALIZZA TAPPE</a>
                        </p>
                        <?php
                        $uscita=$rowVis['ID'];
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
                            <a style="margin-left: 100px" href="visualizzaUscite.php" class="btn btn-primary" role="button" >sei gia iscritto</a>

                            <?php

                        }else{

                        ?>
                        <p><a style="margin-left: 100px" href="partecipaUscita1.php?ID=<?php echo $rowVis['ID']; ?>
                            &tipologia=<?php echo $rowVis['tipologia']; ?>" class="btn btn-primary" role="button">PARTECIPA!</a>
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

    echo accedi;?>  <a href="login.php">Login</a><?php
}


