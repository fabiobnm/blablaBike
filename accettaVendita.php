<?php
include 'header.php';

?>
<h2 class="center">Stai per vendere la tua bici</h2>
<?php

sec_session_start();
if(login_check($mysqli) == true) {
    ?>
        <div class="thumbnail testFlo " style="border-radius: 50px; background-color: deepskyblue; width: 50%">
    <a href="login.php"><h3 style="text-align: center;margin-top: 40px">VENDI!</h3></a></div>
<div class="thumbnail testFlo" style="border-radius: 50px; background-color: red; width: 50%">
    <a href="login.php"><h3 style="text-align: center;margin-top: 40px">rifiuta la richiesta</h3></a></div>
<?php
    }

