<?php


include 'header.php';
?>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail"style="border-radius: 30px">
<form action="process_login.php" method="post" style="margin-left: 80px; margin-top: 10px">
    email<br>
    <input type="email" name="email" required><br><br>
    Password<br>
    <input type="password" name="password" required><br>
    <br>
    <input style="background: lemonchiffon" type="submit" value="ACCEDI">

  <br>
    <br>
    <a href="signin.php" style="text-align: center">vuoi iscriverti? singin</a>
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




