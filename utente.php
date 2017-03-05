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

    <a href="info.php">Modifica le tue informazioni</a>



    </form>

    <form action="process_info.php" method="post">
        cerca uscite dove vuoi<input type="search"><input type="submit">
    </form>

    <?php  if(isset($_GET['error'])) {
        $errore = $_GET['error'];
        echo " <h1>$errore</h1>" ;
    }?>
<?php

} else {

    echo accedicazzo;?>  <a href="login.php">Login</a><?php
}