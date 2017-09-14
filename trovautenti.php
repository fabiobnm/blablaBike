<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'header.php';

sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_POST['trovautente'])) {
    $trovautente = $_POST['trovautente'];






    $query="SELECT  email,utente.nickname FROM utente JOIN informazioni ON utente.nickname= informazioni.nickname
             WHERE informazioni.residenza LIKE '%$trovautente%' AND informazioni.nickname!='ANONYMOUS'";
    $result=mysqli_query($mysqli,$query);

    $querycount="SELECT COUNT(*) as conto FROM utente JOIN informazioni ON utente.nickname= informazioni.nickname
             WHERE informazioni.residenza LIKE '%$trovautente%' AND informazioni.nickname!='ANONYMOUS'";
    $resultcount=mysqli_query($mysqli,$querycount);

    $rowcount=mysqli_fetch_array($resultcount,MYSQLI_ASSOC);

    $conto=$rowcount['conto'];
    echo "<h2>$conto";
    echo ' utenti trovati</h2><br>';
    echo 'Hai cercato utenti a ';
    echo $trovautente."<br><br>";

    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){


        echo $row['email'];
        echo ' ';
        ?> <a href="profilo.php?profilo=<?php echo $row['nickname'];?>"><?php echo $row['nickname'];?></a>
        <br><?php
    }



} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}

?>

