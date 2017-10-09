<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'db_connect.php';
include 'functions.php';
sec_session_start();

if(isset($_POST['bicicletta'],$_POST['titolo'],$_POST['prezzo'],$_POST['descrizione'])) {
    $bicicletta = $_POST['bicicletta'];
    $venditore = $_SESSION['nikname'];
    $titolo= $_POST['titolo'];
    $prezzo = $_POST['prezzo'];
    $descrizione = $_POST['descrizione'];

    $testo="titolo=$titolo&prezzo=$prezzo&descrizione=$descrizione";

    if (empty($_POST['bicicletta']) or (!trim($_POST['bicicletta']))){
        header("location: ./creaAnnuncio.php?$testo&ID=$bicicletta&messaggio10=inserisci bicicletta");
    }else{if (empty($_POST['titolo']) or (!trim($_POST['titolo']))){
        header("location: ./creaAnnuncio.php?$testo&ID=$bicicletta&messaggio1=inserisci titolo");
    }else{if (empty($_POST['prezzo'])or(!is_numeric($_POST['prezzo']))){
        header("location: ./creaAnnuncio.php?$testo&ID=$bicicletta&messaggio2=inserisci prezzo");
    }else{if (empty($_POST['descrizione']) or (!trim($_POST['descrizione']))){
        header("location: ./creaAnnuncio.php?$testo&ID=$bicicletta&messaggio3=inserisci descrizione");
    }else{


    echo "ok fino qui tutto bene ";


    if(creaAnnuncio($titolo,$bicicletta,$venditore,$prezzo,$descrizione,$mysqli) == true) {
        // Login eseguito

        echo 'err';
        header("location: ./garage.php?messaggio=hai messo in vendita la bike");
    } else {
        echo 'errore inserimento';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}}}} }else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}