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
if(isset($_SESSION['nikname'],$_GET['ID'])) {
    $utente = $_SESSION['nikname'];
    $bike=$_GET['ID'];

    echo "ok fino qui tutto bene";
    if(eliminaBike($utente,$bike,$mysqli) == true) {
        // Login eseguito
        header("location: /garage.php?messaggio=hai cancellato");
    } else {
        header("location: /garage.php?messaggio=errore");


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}