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

    echo $bicicletta;
    echo $venditore;
    echo $titolo;
    echo $prezzo;
    echo $descrizione;


    echo "ok fino qui tutto bene diooooooooooo";


    if(creaAnnuncio($titolo,$bicicletta,$venditore,$prezzo,$descrizione,$mysqli) == true) {
        // Login eseguito

        echo 'madonnnnnnnnaaaaaa';
        header("location: /garage.php?messaggio=hai messo in vendita la bike");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}