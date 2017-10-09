<?php
/**

 */
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_SESSION['nikname'], $_GET['IDannuncio'])) {
    $utente = $_SESSION['nikname'];
    $annuncio = $_GET['IDannuncio'];

    echo $utente;
    echo $annuncio;

    echo "ok fino qui tutto bene";

    $query="INSERT INTO richiestaacquisto (annuncio,utente)VALUES($annuncio,'$utente')";
    $mysqli->query($query)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");

    header("location: ./utente.php?messaggio=richiesta aquisto inviata");

} else {
    $utente = 'ANONYMOUS';
    $annuncio = $_GET['IDannuncio'];


    $query="INSERT INTO richiestaacquisto (annuncio,utente)VALUES($annuncio,$utente)";
    $mysqli->query($query)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");

    header("location: ./utente.php?messaggio=richiesta aquisto inviata");

   }
   
