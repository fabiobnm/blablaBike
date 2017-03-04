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
if(isset($_POST['proprietario'], $_POST['nome'],$_POST['tipo'], $_POST['peso'],
    $_POST['ruote'],$_POST['marca'],$_POST['annoFab'], $_POST['annoAcq'],$_POST['colore'])) {
    $proprietario = $_POST['proprietario'];
    $nome = $_POST['nome'];
    $tipo= $_POST['tipo'];
    $peso = $_POST['peso'];
    $ruote = $_POST['ruote'];
    $marca = $_POST['marca'];
    $annoFab = $_POST['annoFab'];
    $annoAcq = $_POST['annoAcq'];
    $colore = $_POST['colore'];// Recupero la password criptata.


    echo "ok fino qui tutto bene";
    if(insertbike($proprietario,$nome,$tipo,$peso,$ruote,$marca,$annoFab,$annoAcq,$colore,$mysqli) == true) {
        // Login eseguito
        header("location: /profilo.php", 'hai modificato');
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}