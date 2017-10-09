
<?php
include 'header.php';




sec_session_start();
if(login_check($mysqli) == true) {

    echo 'sei dentro';

} else {

    ?>
    <div class="row">
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail rad30 larg350">

        <form action="process_signin.php" method="post" class="marg90">

            <?php if(isset($_GET['nik'])) {
                $nik=$_GET['nik'];?>
            <label>Nickname</label><br><input type="text" name="nickname" value="<?php echo $nik?>" onblur="checknick()"><?php if (isset($_GET['error2'])) {
                $error2 = $_GET['error2'];
                echo " <h1 class='erroreros'>$error2</h1>";
            }} else {?><br>
                <label>Nicknamee</label><br><input type="text" name="nickname" onblur="checknick()"><?php if (isset($_GET['error2'])) {
                    $error2 = $_GET['error2'];
                    echo " <h1 class='erroreros'>$error2</h1>";
                }}?><br>

            <?php if(isset($_GET['email'])) {
            $email=$_GET['email'];?>
            <label>Indirizzo e-mail</label><br> <input type="email" value="<?php echo $email?>" name="email" ><?php if (isset($_GET['error1'])) {
                $error1 = $_GET['error1'];
                echo " <h1 class='erroreros'>$error1</h1>";
            }}else {?><br>
            <label>Indirizzo e-mail</label><br> <input type="email" name="email" ><?php if (isset($_GET['error1'])) {
            $error = $_GET['error1'];
            echo " <h1 class='erroreros'>$error1</h1>";}}?><br>

            <label>Password</label> <br> <input type="password" name="password" ><?php if (isset($_GET['error6'])) {
                $error6 = $_GET['error6'];
                echo " <h1 class='erroreros'>$error6</h1>";
            }?><br>

            <label>conferma Password</label> <br> <input type="password" name="confpassword" ><?php if (isset($_GET['error5'])) {
                $error5 = $_GET['error5'];
                echo " <h1 class='erroreros'>$error5</h1>";
            }?><br>
            <br>
    <input class="sublog" type="submit" value="ISCRIVITI">


</form>


    </div>
    </div>
    </div>


<?php if(isset($_GET['error1'])) {
    $error1 = $_GET['error1'];
    echo " <h1>$errore</h1>" ;
}
    if(isset($_GET['messaggio'])) {
        $errore = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>" ;
    }
}

?></div>
</body>
</html>
