<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    ?>
    <h1>utente</h1>


    <?php
   ?>
    <form action="ricercautenti.php" method="post">
        cerca utente:<input type="text"  name="ricercautente"><input type="submit"><br>

        <a href="garage.php">Vai al tuo Garage</a>
    <br>
        <a href="creauscita.php">Crea una nuova Uscita!!</a>
        <br>
     <?php
     $conto = "SELECT count(*) as totale FROM informazioni WHERE nickname='$nickname'";
     $info = mysqli_query($mysqli, $conto);
     $stampa = mysqli_fetch_array($info, MYSQLI_ASSOC);

     if($stampa['totale']==1){
     ?>
    <a href="info.php">Modifica le tue informazioni</a>
     <?php } else {
         ?>
         <a href="info.php">Inserisci le tue informazioni</a>
     <?php }
         ?>


    </form>

    <form action="process_info.php" method="post">
        cerca uscite dove vuoi<input type="search"><input type="submit">
    </form>

    <?php  if(isset($_GET['error'])) {
        $errore = $_GET['error'];
        echo " <h1>$errore</h1>" ;
    }?>
    <?php  if(isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>" ;
    }?>
<?php

} else {

    echo accedicazzo;?>  <a href="login.php">Login</a><?php
}