<?php

include_once "comuni/comuni.php";

echo $head;

$errore="";

# visualizzo i valori dei campi. ATTENZIONE: una applicazione seria deve sempre fare il controllo dell'input

if (!empty($_POST["login"]))
    echo 'login: ' .$_POST["login"].'<br/>';
else $errore= $errore . " manca login, ";

if (!empty($_POST["password"]))
    echo 'password: ' .$_POST["password"].'<br/>';
else $errore= $errore . " manca password, ";

if (!empty($_POST["nome"]))
    echo 'nome: ' .$_POST["nome"].'<br/>';
else $errore= $errore . " manca nome, ";

if (!empty($_POST["cognome"]))
    echo 'cognome: ' .$_POST["cognome"].'<br/>';
else $errore= $errore . " manca cognome, ";


if (!empty($_POST["giorno"]))
    echo 'giorno: ' .$_POST["giorno"].'<br/>';
else $errore= $errore . " manca giorno, ";

if (!empty($_POST["mese"]))
    echo 'mese: ' .$_POST["mese"].'<br/>';
else $errore= $errore . " manca mese, ";

if (!empty($_POST["anno"]))
    echo 'anno: ' .$_POST["anno"].'<br/>';
else $errore= $errore . " manca anno, ";


if (!empty($_POST["sex"]))
    echo 'cognome: ' .$_POST["sex"].'<br/>';
else $errore= $errore . " manca sex, ";

if (!empty($_POST["attivita"]))
{
    echo 'attivita: ';
    $listAttivita=$_POST["attivita"];
    foreach ($listAttivita as $val)
    {echo $val . ", ";}
    echo '<br/>';
}
else $errore= $errore . " manca attivita, ";

if (!empty($_POST["condizioni"]))
    echo 'condizioni: ' .$_POST["condizioni"].'<br/>';
else $errore= $errore . " manca condizioni, ";

if ($errore != "")
    echo $errore .  "<a href='login.html'>riprova</a>";;

echo $tail;

?>