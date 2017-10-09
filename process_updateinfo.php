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
if(isset($_POST['nickname'], $_POST['nome'],$_POST['cognome'], $_POST['dataNascita'],
    $_POST['luogoNascita'],$_POST['residenza'])) {
    $nickname = $_POST['nickname'];
    $nome = $_POST['nome'];
    $cognome= $_POST['cognome'];
    $dataNascita = $_POST['dataNascita'];
    $luogoNascita = $_POST['luogoNascita'];
    $sesso = $_POST['sesso'];
    $residenza = $_POST['residenza'];
    $esperienza = $_POST['esperienza'];// Recupero la password criptata.

    $teso="nome=$nome&cognome=$cognome&data=$dataNascita&luogo=$luogoNascita&residenza&$residenza";
    if (empty($_POST['nome'])){
        header("location: ./info.php?$teso&messaggio0=inserisci nome");
    }else{if (empty($_POST['cognome']) or (!trim($_POST['cognome']))){
        header("location: ./info.php?$teso&messaggio1=inserisci cognome");
    }else{if (empty($_POST['dataNascita'])){
        header("location: ./info.php?$teso&messaggio2=inserisci data");
    }else{if (empty($_POST['luogoNascita']) or (!trim($_POST['luogoNascita']))){
        header("location: ./info.php?$teso&messaggio3=inserisci luogo");
    }else{if (empty($_POST['residenza']) or (!trim($_POST['residenza']))){
        header("location: ./info.php?$teso&messaggio4=inserisci residenza");
    }else{if (empty($_POST['esperienza']) ){
        header("location: ./info.php?$teso&messaggio6=inserisci esperienza");
    }else
    echo "ok fino qui tutto bene";
    if(updateinfo($nickname,$nome,$cognome,$dataNascita,$luogoNascita,$sesso,$residenza,$esperienza,$mysqli) == true)  {
        // Login eseguito
        header("location: ./utente.php?messaggio=hai modificato le tue info");
        echo 'Hai modificato i tuoi dati!';
    } else {
        echo 'errore database';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}}}}}} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}