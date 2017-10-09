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
        $query="INSERT INTO utente (nickname,email,password)VALUES('$nickname','$email','$password')";
        $mysqli->query($query);
        $a=$mysqli->error;
        if (strpos($a, 'email') == true) {
            echo $a;
            echo 'true';
            header("location: ./signin.php?&nik=$nickname&email=$email&error1=email gia presente");}else{
        if (strpos($a, 'PRIMARY') == true) {
            echo $a;
            echo 'true';
            header("location: ./signin.php?&nik=$nickname&email=$email&error2=nickname gia presente");}else{

        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

        //$user_id = preg_replace("/[^0-9]+/", "", $nikname); // ci proteggiamo da un attacco XSS
        $_SESSION['nikname'] = $nickname;
        //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
        $_SESSION['email'] = $email;
        $_SESSION['login_string'] =  $password.$user_browser;
        //$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
        // Login eseguito con successo.

        header("location: ./info.php?messaggio=ti sei registrato può inserire informazione");

    }}}else{header("location: ./signin.php?nik=$nickname&email=$email&error5=conferma password sbagliata");}
}
else
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
