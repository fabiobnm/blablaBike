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
    $ricercautente = strtoupper($_POST['ricercautente']);




   /* $stmt = $mysqli->query("SELECT * FROM utente WHERE nickname LIKE '%c%'");
    //$data = $stmt->fetch_array(PDO::FETCH_ASSOC);
    $data = $stmt->fetch_all(PDO::FETCH_ASSOC);
    $json =  json_encode($data);
    $testmail = $json[0];
    echo $json; */


    $query="SELECT * FROM utente WHERE nickname LIKE '%$ricercautente%' ";
    $result=mysqli_query($mysqli,$query);




    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

        echo $row['email'];
        echo ' ';
       ?> <a href="profilo.php?profilo=<?php echo $row['nickname'];?>"><?php echo $row['nickname'];?></a>
         <br><?php
    }







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

