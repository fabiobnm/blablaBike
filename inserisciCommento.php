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
if(login_check($mysqli) == true) {
    $nickname = $_SESSION["nikname"];
}else {
    $nickname='anonymous';

}



if(isset($_POST['testo'],$_POST['annuncio'])) {
    $testo = $_POST['testo'];
    $annuncio=$_POST['annuncio'];



    echo "ok fino qui tutto benemyo";



    if(inserisciCommento($testo,$nickname,$annuncio,$mysqli) == true) {
        // Login eseguito
        header("location: /commenti.php?IDannuncio=$annuncio");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}