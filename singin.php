<?php
include 'header.php';
include 'db_connect.php';
include 'functions.php';

sec_session_start();
if(login_check($mysqli) == true) {

// Inserisci qui il contenuto delle tue pagine!
    echo 'sei dentro';

} else {

    ?>


        <a href="index.php">


            <img src="img/blablacar-ridesharing-logo-1.svg" alt="carhhgddf" style="width:254px;height:228px;"></a>



        <form action="process_singin.php" method="post">

        Indirizzo e-mail<br> <input type="text" name="email"><br>
        Nicknameeeeeeeeeeeeeee<br><input type="text" name="nickname" ><br>
    Password <br> <input type="password" name="password"><br>
            <br>
    <input style="background: lemonchiffon" type="submit"value="ISCRIVITI">
</form>




<?php
}