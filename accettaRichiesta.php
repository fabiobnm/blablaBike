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
if(isset($_SESSION['nikname'], $_GET['profilo'])) {
    $utente = $_SESSION['nikname'];
    $seguitoDa = $_GET['profilo'];

    $query="UPDATE segue SET approvato = 1, data= CURRENT_DATE 
     WHERE utente='$seguitoDa' && seguitoDa='$utente'";
    $mysqli->query($query)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");

   /* if(accettaRichiesta($utente,$seguitoDa,$mysqli) == true) {
        // Login eseguito
      */  header("location: ./visualizzaRichieste.php");

} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}