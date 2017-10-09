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
if(isset($_POST['email'], $_POST['password'],$_POST['nickname'],$_POST['confpassword']))
{
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $nickname = strtoupper($_POST['nickname']);
    $confpassword= $_POST['confpassword'];

    if(($password==$confpassword)and(!empty($_POST['password'])))
    {
        if (emailEsiste($email, $mysqli) == true)
        {
            if (login($email, $password, $mysqli) == true)
            {

                header("location: ./utente.php?messaggio=eri gia registrato");
            } else
                header("location: ./signin.php?nik=$nickname&email=$email&error=email gia esistente");

        }else  { if((nickEsiste($nickname,$mysqli)==true)or (empty($_POST['nickname']))){

            header("location: ./signin.php?nik=$nickname&email=$email&error1=nickname gia usato o da inserire");
        }

        else{



            if(singin($email, $password, $nickname, $mysqli)==true){
                creafiltri($nickname,$mysqli);

                if(creafiltri($nickname,$mysqli)==true) {

                }
                header("location: ./info.php?messaggio=ti sei registrato può inserire informazione");
            }
            else
                header("location: ./signin.php?error=problemi al database");


        }}



    }else  header("location: ./signin.php?nik=$nickname&email=$email&error2=conferma password sbagliata");


} else
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';

