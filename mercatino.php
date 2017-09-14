<?php
include 'header.php';

?>
 <body style="background: gold"></body>
<?php


sec_session_start();

     $nickname=$_SESSION['nikname'];

if(login_check($mysqli) == true) {

    ?><a href="garage.php">vendi una bici dal tuo Garage</a>
    <br>

<form action="filtraMercatino.php" method="get">
    <label> modifica filtro bike</label>
    <select name="tipo" >
        <option value="" disabled selected>tipo </option>
        <option value="0" >mountain </option>
        <option value="1" >corsa </option>
    </select>

           <select name="marca" >
        <option value="" disabled selected>marca </option>
           <?php    $query = "SELECT DISTINCT marca FROM bicicletta ";
               $result = mysqli_query($mysqli, $query);

               while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
               $marca=$row['marca'];
               ?>

               <option value="<?php echo $marca;?>" ><?php   echo $marca;?>  </option>

               <?php }?>

           </select>

    <select name="colore" >
        <option value="" disabled selected>colore</option>
        <?php    $queryCol = "SELECT DISTINCT colore FROM bicicletta ";
        $resultCol = mysqli_query($mysqli, $queryCol);

        while ($rowCol = mysqli_fetch_array($resultCol, MYSQLI_ASSOC)){
            $colore=$rowCol['colore'];
            ?>

            <option value="<?php echo $colore;?>" ><?php   echo $colore;?>  </option>

        <?php }?>
    </select>

    <select name="annoFabmin" >
        <option value="" disabled selected>anno produzione min</option>
        <?php    $queryFabmin = "SELECT DISTINCT annoFab FROM bicicletta ORDER BY annoFab";
        $resultFabmin = mysqli_query($mysqli, $queryFabmin);

        while ($rowFabmin = mysqli_fetch_array($resultFabmin, MYSQLI_ASSOC)){
            $annoFabmin=$rowFabmin['annoFab'];
            ?>

            <option value="<?php echo $annoFabmin;?>" ><?php   echo $annoFabmin;?>  </option>

        <?php }?>

    </select>

    <select name="annoFabmax" >
        <option value="" disabled selected>anno produzione max</option>
        <?php
        $queryFabmax = "SELECT DISTINCT annoFab FROM bicicletta ORDER BY annoFab DESC ";
        $resultFabmax = mysqli_query($mysqli, $queryFabmax);

        while ($rowFabmax = mysqli_fetch_array($resultFabmax, MYSQLI_ASSOC)){
            $annoFabmax=$rowFabmax['annoFab'];
            ?>

            <option value="<?php echo $annoFabmax;?>" ><?php   echo $annoFabmax;?>  </option>

        <?php }?>

    </select>


           <input style="background: lemonchiffon;border-radius: 30px" type="submit"value="CERCA">
    <input style="background: orangered;border-radius: 30px" type="submit"value="elimina filtri">

</form>
<?php


     $prova="select query,testo  from filtromercatino where nickname='$nickname'";
$risultatoprova=mysqli_query($mysqli, $prova);
$provaprova=mysqli_fetch_array($risultatoprova,MYSQLI_ASSOC);
$definitiva=$provaprova['query'];
$testo=$provaprova['testo'];

if(empty(trim($definitiva))){echo ' ';}
else{
echo "<h3>filtro inserito:$testo</h3>";}


     $contoquery="select count(*) as conto FROM annuncio JOIN bicicletta ON bicicletta.ID = annuncio.bicicletta WHERE $definitiva data BETWEEN 
       DATE_SUB(CURRENT_DATE ,INTERVAL 1000 DAY) AND CURRENT_DATE+1 ";
     $risultatoconto=mysqli_query($mysqli, $contoquery);
     $conto=mysqli_fetch_array($risultatoconto,MYSQLI_ASSOC);

     echo '<h3 style="text-align: center">Ci sono ';
     echo $conto['conto'];
     echo ' biciclette in vendita!!</h3>';
    $query = "SELECT * FROM annuncio JOIN bicicletta ON bicicletta.ID = annuncio.bicicletta WHERE $definitiva data BETWEEN 
       DATE_SUB(CURRENT_DATE ,INTERVAL 1000 DAY) AND CURRENT_DATE+1 ";
    $result = mysqli_query($mysqli, $query);




    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
           $bike=$row['ID'];
           $annuncio=$row['IDannuncio'];
        ?>
        <div class=" ">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style="border-radius: 80px; background-color: aquamarine; height: 600px">

                    <img <?php if ($row['tipo'] == 0){ ?>src="img/mountainVera%202.jpg" style="border-radius: 80px;
                       margin-left: auto;height: 190px;background-color: white" <?php } else ?> src="img/corsaVera%202.jpg"
                         style="border-radius: 80px;height: 190px;;width: 2000px;
                       margin-left: auto;background-color: white"
                         alt="vvvv">
                    <div class="caption">
                        <h3 style="text-align: center"><?php echo $row["titolo"]; ?></h3>
                        <p>Bike da <?php if ($row["tipo"] == 0) {
                                echo 'mountain';
                            } else {
                                echo 'corsa';
                            } ?>, di colore <?php echo $row["colore"]; ?> venduta da <br><?php echo $row["proprietario"]?>.<br>
                        Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br>
                        PREZZO: <?php echo $row["prezzo"]; ?>€<br>
                        MARCA: <?php echo $row["marca"]; ?><br>
                        MODELLO: <?php echo $row["modello"]; ?></p>
                        <p style="color: orange; text-align: center"><?php echo $row["descrizione"]; ?></p>

                        <?php
                        if($row['proprietario']==$_SESSION['nikname']){
                            ?>
                            <a style="text-align: center">         STAI VENDENDO QUESTA BIKE</a><br>
                            <a style="width: 100%;border-radius: 30px" href="cancellaAnnuncio.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">CANCELLA ANNUNCIO</a><br>
                            <?php

                        } else { ?>
                        <a style="text-align: center"> </a><br>
                    <?php
                        $queryRichiesta = "SELECT COUNT(*) AS  contoRichiesta FROM richiestaacquisto WHERE utente='$nickmane' && annuncio=$annuncio";
                        $resultRichiesta = mysqli_query($mysqli, $queryRichiesta);
                        $rowRichiesta = mysqli_fetch_array($resultRichiesta, MYSQLI_ASSOC);

                        if($rowRichiesta['contoRichiesta']>=1){

                        ?>   <br>
                        <p><a style="width: 100%; border-radius: 30px" href="acquistoRichiesta.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">Richiesta in ATTESA</a><br>

                            <?php  }
                        else{?>
                        <p><a style="width: 100%; border-radius: 30px" href="acquistoRichiesta.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">Invia richiesta d'acquisto</a><br>

                            <?php


                        }} ?><br>
                            <a style="width: 100%;border-radius: 30px"
                                href="commenti.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-default" role="button">commenti</a>
                            </p>
                   <?php
                   $rubata="SELECT COUNT(*) as conto FROM commento JOIN annuncio ON annuncio.IDannuncio = commento.annuncio JOIN
                bicicletta ON annuncio.bicicletta = bicicletta.ID 
              WHERE bicicletta.ID = $bike  && commento.testo LIKE '%rubat%'";
                  $resultRubata = mysqli_query($mysqli, $rubata);
                $cavolo = mysqli_fetch_array($resultRubata, MYSQLI_ASSOC);

                if ($cavolo['conto']>=1){

                  ?>  <a style="background: red ;color: white ;font-weight: bold ;margin-right: auto;margin-left: 42px;border-radius: 30px" href="commenti.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">la bike potrebbe essere rubata</a>
                    <?php

                }




                   ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }}
    else{ ?><a href="garage.php">vendi una bici dal tuo Garage</a>
        <br>

        <form >
            <label> modifica filtro bike</label>
            <select name="tipo" >
                <option value="" disabled selected>tipo </option>
                <option value="0" >mountain </option>
                <option value="1" >corsa </option>
            </select>

            <select name="marca" >
                <option value="" disabled selected>marca </option>
                <?php    $query = "SELECT DISTINCT marca FROM bicicletta ";
                $result = mysqli_query($mysqli, $query);

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $marca=$row['marca'];
                    ?>

                    <option value="<?php echo $marca;?>" ><?php   echo $marca;?>  </option>

                <?php }?>

            </select>

            <select name="colore" >
                <option value="" disabled selected>colore</option>
                <?php    $queryCol = "SELECT DISTINCT colore FROM bicicletta ";
                $resultCol = mysqli_query($mysqli, $queryCol);

                while ($rowCol = mysqli_fetch_array($resultCol, MYSQLI_ASSOC)){
                    $colore=$rowCol['colore'];
                    ?>

                    <option value="<?php echo $colore;?>" ><?php   echo $colore;?>  </option>

                <?php }?>
            </select>

            <select name="annoFabmin" >
                <option value="" disabled selected>anno produzione min</option>
                <?php    $queryFabmin = "SELECT DISTINCT annoFab FROM bicicletta ORDER BY annoFab";
                $resultFabmin = mysqli_query($mysqli, $queryFabmin);

                while ($rowFabmin = mysqli_fetch_array($resultFabmin, MYSQLI_ASSOC)){
                    $annoFabmin=$rowFabmin['annoFab'];
                    ?>

                    <option value="<?php echo $annoFabmin;?>" ><?php   echo $annoFabmin;?>  </option>

                <?php }?>

            </select>

            <select name="annoFabmax" >
                <option value="" disabled selected>anno produzione max</option>
                <?php
                $queryFabmax = "SELECT DISTINCT annoFab FROM bicicletta ORDER BY annoFab DESC ";
                $resultFabmax = mysqli_query($mysqli, $queryFabmax);

                while ($rowFabmax = mysqli_fetch_array($resultFabmax, MYSQLI_ASSOC)){
                    $annoFabmax=$rowFabmax['annoFab'];
                    ?>

                    <option value="<?php echo $annoFabmax;?>" ><?php   echo $annoFabmax;?>  </option>

                <?php }?>

            </select>


            <input style="background: lemonchiffon;border-radius: 30px" type="submit"value="CERCA">
        </form>
        <?php
        if(isset($_GET['tipo'])){
            $tipoS=$_GET['tipo'];
            $Qtipo=' tipo='.$tipoS.' AND ';
            echo 'tipo='.$tipoS.'';
        }
        if(isset($_GET['marca'])){
            $marcaS=$_GET['marca'];
            $Qmarca=' marca="'.$marcaS.'" AND ';
            echo 'marca='.$marcaS.'';
        }
        if(isset($_GET['colore'])){
            $coloreS=$_GET['colore'];
            $Qcolore=' colore= "'.$coloreS.'" AND ';
            echo ' colore='.$coloreS.'';
        }
        if(isset($_GET['annoFabmin'])){
            $fabminS=$_GET['annoFabmin'];
            $Qfabmin=' annoFab>='.$fabminS.' AND ';
            echo ' anno fabbricazione mix='.$fabminS.'';
        }
        if(isset($_GET['annoFabmax'])){
            $fabmaxS=$_GET['annoFabmax'];
            $Qfabmax=' annoFab<='.$fabmaxS.' AND ';
            echo ' anno fabbricazione max='.$fabmaxS.'';
        }



        $contoquery="select count(*) as conto FROM annuncio JOIN bicicletta ON bicicletta.ID = annuncio.bicicletta WHERE $Qtipo $Qmarca
        $Qcolore $Qfabmin $Qfabmax IDannuncio>=1";
        $risultatoconto=mysqli_query($mysqli, $contoquery);
        $conto=mysqli_fetch_array($risultatoconto,MYSQLI_ASSOC);

        echo '<h3 style="text-align: center">Ci sono ';
        echo $conto['conto'];
        echo ' biciclette in vendita!!</h3>';
        $query = "SELECT * FROM annuncio JOIN bicicletta ON bicicletta.ID = annuncio.bicicletta WHERE $Qtipo $Qmarca
        $Qcolore $Qfabmin $Qfabmax IDannuncio>=1";
        $result = mysqli_query($mysqli, $query);




        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $bike=$row['ID'];
            $annuncio=$row['IDannuncio'];
            ?>
            <div class=" ">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" style="border-radius: 80px; background-color: aquamarine; height: 550px">

                        <img <?php if ($row['tipo'] == 0){ ?>src="img/mountainVera%202.jpg" style="border-radius: 80px;
                       margin-left: auto;background-color: white" <?php } else ?> src="img/corsaVera%202.jpg"
                             style="border-radius: 80px;
                      margin-left: auto;background-color: white"
                             alt="vvvv">
                        <div class="caption">
                            <h3 style="text-align: center"><?php echo $row["titolo"]; ?></h3>
                            <p>Bike da <?php if ($row["tipo"] == 0) {
                                    echo 'mountain';
                                } else {
                                    echo 'corsa';
                                } ?>, di colore <?php echo $row["colore"]; ?> venduta da <?php echo $row["proprietario"]?>.<br>
                                Prodotta nel <?php echo $row["annoFab"]; ?> e acquistata dall'utente nel <?php echo $row["annoAcq"]; ?><br>
                                PREZZO: <?php echo $row["prezzo"]; ?>€<br>
                                MARCA: <?php echo $row["marca"]; ?><br>
                                MODELLO: <?php echo $row["modello"]; ?></p>
                            <p style="color: orange; text-align: center"><?php echo $row["descrizione"]; ?></p>

                            <?php
                            if($row['proprietario']==$_SESSION['nikname']){
                                echo 'STAI VENDENDO QUESTA BIKE';?>
                                <a style="margin-left: 21px" href="cancellaAnnuncio.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">CANCELLA ANNUNCIO</a>
                                <?php

                            } else {
                            $queryRichiesta = "SELECT COUNT(*) AS  contoRichiesta FROM richiestaacquisto WHERE utente='$nickmane' && annuncio=$annuncio";
                            $resultRichiesta = mysqli_query($mysqli, $queryRichiesta);
                            $rowRichiesta = mysqli_fetch_array($resultRichiesta, MYSQLI_ASSOC);

                            if($rowRichiesta['contoRichiesta']>=1){

                            ?>
                        <p><a style="margin-left: 21px" href="acquistoRichiesta.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">Richiesta in ATTESA</a>

                        <?php  }
                        else{?>
                            <p><a style="margin-left: 21px" href="acquistoRichiesta.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">Invia richiesta d'acquisto</a>

                                <?php


                                }} ?>
                                <a
                                        href="commenti.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-default" role="button">commenti</a>
                            </p>
                            <?php
                            $rubata="SELECT COUNT(*) as conto FROM commento JOIN annuncio ON annuncio.IDannuncio = commento.annuncio JOIN
                bicicletta ON annuncio.bicicletta = bicicletta.ID 
              WHERE bicicletta.ID = $bike  && commento.testo LIKE '%rubat%'";
                            $resultRubata = mysqli_query($mysqli, $rubata);
                            $cavolo = mysqli_fetch_array($resultRubata, MYSQLI_ASSOC);

                            if ($cavolo['conto']>=1){

                                ?>  <a style="background: red ;color: white ;font-weight: bold ;margin-right: auto;margin-left: 42px;border-radius: 30px" href="commenti.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">la bike potrebbe essere rubata</a>
                                <?php

                            }




                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }



    }

