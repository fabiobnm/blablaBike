<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_SESSION['nikname'],$_GET['ID'],$_GET['ACQ'])) {
    $utente = $_SESSION['nikname'];
    $bike=$_GET['ID'];
    $ACQ=$_GET['ACQ'];
    $anno= date('Y');


    echo "ok fino qui tutto bene";
    if(cambiaprop($ACQ,$bike,$anno,$mysqli) == true) {
        // Login eseguito
        header("location: ./garage.php?messaggio=hai venduto la tua bike");
    } else {
        header("location: ./garage.php?messaggio=errore");


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}