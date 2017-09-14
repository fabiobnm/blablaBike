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
if(isset($_POST['uscita'], $_POST['valutazione'])) {
    $utente=$_SESSION['nikname'];
    $valutazione = $_POST['valutazione'];
    $usicta = $_POST['uscita'];// Recupero la password criptata.



    echo "ok fino qui tutto bene";

    if(valutaUscita($usicta,$utente,$valutazione,$mysqli) == true) {
        // Login eseguito
        header("location: /utente.php?messaggio=hai inserito valutazione");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}