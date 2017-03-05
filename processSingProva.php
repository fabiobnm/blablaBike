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


    if (emailEsiste($email, $mysqli) == true) {
        // singin eseguito
        if (login($email, $password, $mysqli) == true) {

            header("location: /utente.php?error=eri gia registrato");
        } else  {
            header("location: /singin.php?error=email gia esistente");
        }




        }
     else{ if(nickEsiste($nickname,$mysqli)==true){

    header("location: /singin.php?error=nickname gia usato");
}
     else{
        if(singin($email, $password, $nickname, $mysqli)==true){

            header("location: /utente.php?error=ti sei registrato può inserire informazione");
        }
     else{
         header("location: /singin.php?error=probblemi");
     }
     }
     }}
   else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}