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
if(isset($_POST['ricercautente'])) {
    $ricercautente = $_POST['ricercautente'];


    echo "ok fino qui tutto uiui";

   /* $stmt = $mysqli->query("SELECT * FROM utente WHERE nickname LIKE '%c%'");
    //$data = $stmt->fetch_array(PDO::FETCH_ASSOC);
    $data = $stmt->fetch_all(PDO::FETCH_ASSOC);
    $json =  json_encode($data);
    $testmail = $json[0];
    echo $json; */


    $stmt = $mysqli->query("SELECT * FROM utente WHERE nickname LIKE '%c%'");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email); // recupera il risultato della query e lo memorizza nelle relative variabili.
    $stmt->fetch();









    /*
    if($test = ricercautente($ricercautente,$mysqli) == true) {
        // Login eseguito
        echo $test;
        echo 'visualizza il profilo di ccc ';

        echo '<a href="http://localhost:8080/profilo.php?profilo='.$ricercautentex.'">'.$ricercautente.'</a>';

    } else {
        echo 'non esiste';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }*/
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}

?>

