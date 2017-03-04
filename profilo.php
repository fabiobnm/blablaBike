<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    if(isset($_GET['profilo'])==true){

        $nickname=$_GET['profilo'];
        echo '<h1>sei nel profilo di '.$nickname.'</h1>';

    } else{

        echo 'ciao ',$_SESSION['nikname'];
        echo '!!, sei nel tuo profilo';

    }

    ?>
    <h1>profilo</h1>

    <?php


// Inserisci qui il contenuto delle tue pagine!

} else {

    echo 'accedicazzo';?>  <a href="login.php">Login</a><?php
}