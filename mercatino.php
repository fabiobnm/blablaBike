<?php
include 'header.php';

?>
 <body style="background: #B67D49"></body>
<?php


sec_session_start();



    $query = "SELECT * FROM annuncio JOIN bicicletta ON bicicletta.ID = annuncio.bicicletta";
    $result = mysqli_query($mysqli, $query);




    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
           $bike=$row['ID'];
        ?>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style="border-radius: 50px">

                    <img <?php if ($row['tipo'] == 0){ ?>src="img/montagna.svg"<?php } else ?> src="img/strada.svg"
                         alt="vvvv">
                    <div class="caption">
                        <h3><?php echo $row["titolo"]; ?></h3>
                        <p>è una bici da<?php if ($row["tipo"] == 0) {
                                echo 'mountain';
                            } else {
                                echo 'corsa';
                            } ?> di colore <?php echo $row["colore"]; ?> venduta da <?php echo $row["proprietario"]?> </p>
                        <p><a href="eliminaBike.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">Invia richiesta d'acquisto</a>
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

                  ?>  <a style="background: red ;color: white ;font-weight: bold ;margin-right: auto;margin-left: 37px" href="commenti.php?IDannuncio=<?php echo $row['IDannuncio']; ?>" class="btn btn-primary" role="button">la bike potrebbe essere rubata</a>
                    <?php

                }




                   ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

