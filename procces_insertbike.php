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
if(isset($_POST['proprietario'], $_POST['nome'],$_POST['tipo'],$_POST['marca'],$_POST['modello'], $_POST['peso'],
    $_POST['ruote'],$_POST['annoFab'], $_POST['annoAcq'],$_POST['colore'])) {
    $proprietario = strtoupper($_POST['proprietario']);
    $nome = strtoupper($_POST['nome']);
    $tipo= $_POST['tipo'];
    $marca = strtoupper($_POST['marca']);
    $modello = strtoupper($_POST['modello']);
    $peso = $_POST['peso'];
    $ruote = $_POST['ruote'];
    $annoFab = $_POST['annoFab'];
    $annoAcq = $_POST['annoAcq'];
    $colore = $_POST['colore'];// Recupero la password criptata.



    echo "ok fino qui tutto bene";
    if(insertbike($proprietario,$nome,$tipo,$marca,$modello,$peso,$ruote,$annoFab,$annoAcq,$colore,$mysqli) == true) {
        // Login eseguito
        header("location: /garage.php?messaggio=hai inserito una bike");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}