<?php
/**

 */
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_SESSION['nikname'], $_GET['IDannuncio'])) {
    $utente = $_SESSION['nikname'];
    $annuncio = $_GET['IDannuncio'];

    echo "ok fino qui tutto bene";
    if(acquistoRichiesta($annuncio,$utente,$mysqli) == true) {

        // Login eseguito
        header("location: /utente.php?messaggio=richiesta aquisto inviata");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    $utente = 'ANONYMOUS';
    $annuncio = $_GET['IDannuncio'];

    echo "ok fino qui tutto bene";
    if(acquistoRichiesta($annuncio,$utente,$mysqli) == true) {

        // Login eseguito
        header("location: /mercatino.php?messaggio=richiesta aquisto inviata");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}