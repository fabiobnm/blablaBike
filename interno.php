<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];
    $_SESSION["IDuscita"]=$_GET["ID"];
    $_SESSION["tipoUscita"]=$_GET['tipologia'];



    header("location: /partecipaUscita1.php");

    ?>


    <?php
// Inserisci qui il contenuto delle tue pagine!

} else {

    echo 'invalid';
}