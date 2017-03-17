<?php
/**
 * Created by PhpStorm
 * User: BNM
 * Date: 24/02/17
 * Time: 17:36
 */

include 'header.php';
?>

<form action="process_login.php" method="post">
    email<br>
    <input type="text" name="email"><br>
    Password<br>
    <input type="password" name="password"><br>
    <br>
    <input style="background: lemonchiffon" type="submit" value="ACCEDI">

  <?php  if(isset($_GET['error'])) {
      $errore = $_GET['error'];
    echo " <h1>$errore</h1>" ;
  }?>
    <?php  if(isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1>$messaggio</h1>" ;
    }?>

   </form>

   <a href="signin.php">vuoi iscriverti? singin</a>


