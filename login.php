<?php


include 'header.php';
?>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail rad30">
<form action="process_login.php" method="post" class="login">
    <?php if(isset($_GET['email'])) {
        $email=$_GET['email'];?>
        <input type="email" name="email" value="<?php echo $email?>" required><br><br>
    <?php }else{?>
    email<br>
    <input type="email" name="email" required><br><br>
<?php }?>
    Password<br>
    <input type="password" name="password" required><br>
    <br>
    <input class="sublog" type="submit" value="ACCEDI">

  <br>
    <br>
    <a href="signin.php" class="center">vuoi iscriverti? singin</a>
   </form>

        </div>
    </div>
</div>

<?php  if(isset($_GET['error'])) {
    $errore = $_GET['error'];
    echo " <h1>$errore</h1>" ;
}?>
<?php  if(isset($_GET['messaggio'])) {
    $messaggio = $_GET['messaggio'];
    echo " <h1>$messaggio</h1>" ;
}?>

</div>
</body>
</html>




