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
if(isset($_POST['email'], $_POST['password'],$_POST['nickname'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nickname = $_POST['nickname'];// Recupero la password criptata.


    if(singin($email, $password,$nickname, $mysqli) == true) {
        // singin eseguito
        header("location: /utente.php");


    } else {
        echo 'errore';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}