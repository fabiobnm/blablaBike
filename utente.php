<?php
include 'header.php';
include 'db_connect.php';
include 'functions.php';

sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    ?>
    <a href="index.php">


        <img src="img/blablacar-ridesharing-logo-1.svg" alt="carhhgddf" style="width:254px;height:228px;"></a>

    <form action="process_info.php" method="post">

            <input type="radio" name="sesso" id="inlineRadio1" value=1> UOMO
        </label>
        <label class="radio-inline">
            <input type="radio" name="sesso" id="inlineRadio2" value=0> DONNA
        </label><br>
        residenza: <input type="text" name="residenza"><br>
        esperienza: <label class="radio-inline">
            <input type="radio" name="esperienza" id="inlineRadio1" value=1> PRINCIPIANTE
        </label>
        <label class="radio-inline">
            <input type="radio" name="esperienza" id="inlineRadio2" value=0> ESPERTO
        </label><br>
        <input type="submit">
    </form>


    <?php
// Inserisci qui il contenuto delle tue pagine!

} else {

    echo accedicazzo;?>  <a href="login.php">Login</a><?php
}