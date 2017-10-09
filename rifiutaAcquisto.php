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
if(isset($_GET['annuncio'],$_GET['utente'])) {
    $utente = $_GET['utente'];
    $annuncio=$_GET['annuncio'];

    echo "ok fino qui tutto bene";
    if(rifiutaAcquisto ($annuncio,$utente,$mysqli) == true) {
        // Login eseguito
        header("location: ./visualAcquRic.php?messaggio=hai cancellato");
    } else {
        echo 'problemi database';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}