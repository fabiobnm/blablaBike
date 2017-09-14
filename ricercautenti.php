<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'header.php';

sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_POST['ricercautente'])) {
    $ricercautente = strtoupper($_POST['ricercautente']);






    $query="SELECT  email,nickname FROM utente WHERE nickname LIKE '%$ricercautente%' AND nickname!='ANONYMOUS'";
    $result=mysqli_query($mysqli,$query);

    $querycount="SELECT COUNT(*) as conto FROM utente WHERE nickname LIKE '%$ricercautente%' AND nickname!='ANONYMOUS'";
    $resultcount=mysqli_query($mysqli,$querycount);

    $rowcount=mysqli_fetch_array($resultcount,MYSQLI_ASSOC);

    $conto=$rowcount['conto'];
    echo "<h2>$conto";
    echo ' utenti trovati</h2><br>';

    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){


        echo $row['email'];
        echo ' ';
       ?> <a href="profilo.php?profilo=<?php echo $row['nickname'];?>"><?php echo $row['nickname'];?></a>
         <br><?php
    }

     ?>  <h2>Aggiungi utenti isolati</h2><?php


    $queryisolato="SELECT email,nickname from utente where nickname not IN (SELECT utente from segue WHERE approvato=1) 
    and nickname NOT IN(SELECT seguitoDa from segue WHERE approvato=1)AND nickname!='ANONYMOUS' AND
     nickname not in (SELECT utente FROM partecipa WHERE uscita IN (SELECT ID from uscita where dataIncontro 
     BETWEEN DATE_SUB(CURRENT_DATE,INTERVAL 1 YEAR) AND CURRENT_DATE))";

    $utenteisolato=mysqli_query($mysqli,$queryisolato);

    while($rowisolato=mysqli_fetch_array($utenteisolato,MYSQLI_ASSOC)){

        echo $rowisolato['email'];
        echo ' ';
        ?> <a href="profilo.php?profilo=<?php echo $rowisolato['nickname'];?>"><?php echo $rowisolato['nickname'];?></a>
        <br><?php
    }





} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}

?>

