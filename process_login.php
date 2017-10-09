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


if(isset($_POST['email'], $_POST['password'])) {
    $email = strtolower($_POST['email']);
    $password = $_POST['password']; // Recupero la password criptata.


   if(login($email, $password, $mysqli) == true) {
        // Login eseguito
        //echo 'Success: sei loggato!';
        header("location: ./utente.php");
     ?>


<?php
    } else {

        header("location: ./login.php?email=$email&error= non sei registrato o hai sbagliato gli inserimenti");




        ?>
<a href="signin.php">iscriviti</a>

<?php


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}