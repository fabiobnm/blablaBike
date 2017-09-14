<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {

    echo 'sei dentro';

} else {

    ?>


    <div class="row">
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail" style="border-radius: 30px">

        <form action="process_signin.php" method="post" style="margin-left: 90px">

            <label>Nickname</label><br><input type="text" name="nickname" required><br>
            <label>Indirizzo e-mail</label><br> <input type="email" name="email" required><br>
            <label>Password</label> <br> <input type="password" name="password" required><br>
            <label>conferma Password</label> <br> <input type="password" name="confpassword" required><br>
            <br>
    <input style="background: lemonchiffon" type="submit"value="ISCRIVITI">


</form>

    </div>
    </div>
    </div>


<?php if(isset($_GET['error'])) {
    $errore = $_GET['error'];
    echo " <h1>$errore</h1>" ;
}
    if(isset($_GET['messaggio'])) {
        $errore = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>" ;
    }
}