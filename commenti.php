<?php
include 'header.php';


?>
<body style="background: #B67D49"></body>
<?php

sec_session_start();


$annuncio=$_GET['IDannuncio'];

$query = "SELECT * FROM commento WHERE annuncio='$annuncio'";
$result = mysqli_query($mysqli, $query);
echo 'commenti annuncio N°';
echo $_GET['IDannuncio'];

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    ?>
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-sm-6 col-md-4">


                <div class="chat">

                    <?php if ($row["utente"]!='anonymous'){?>
                    <a href="profilo.php?profilo=<?php echo $row["utente"]; ?>">
                        <h3 style="color: gold; font-weight: bold "><?php echo $row["utente"]; ?></h3>
                    </a><?php } else{?>
                        <h3 style="color: gold; font-weight: bold "><?php echo $row["utente"]; ?></h3>
                    <?php
                    }?>


                    <h3 style="color: white; font-weight: bold">
                        <?php echo $row["testo"]; ?>
                    </h3>
                    <p style="color: white"><?php echo $row["data"]; ?></p>

                </div>
        </div>
    </div>

    <?php
}
?>


<form action="inserisciCommento.php" method="post">
Inserisci un commento: <input type="text" name="testo">
        <input type="hidden" value="<?php echo $annuncio;?>" name="annuncio">
    <input type="submit"style="background: deeppink;color: gold;   border-radius: 20px" value="INVIA">

</form>