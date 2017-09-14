<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura

   $nickname = $_SESSION['nikname'];
if(isset($_GET['tipo'])){
    $tipoS=$_GET['tipo'];
    $Qtipo=' tipo='.$tipoS.' AND ';
    $testotipo='tipo='.$tipoS.', ';
}
if(isset($_GET['marca'])){
    $marcaS=$_GET['marca'];
    $Qmarca=' marca="'.$marcaS.'" AND ';
    $testomarca='marca='.$marcaS.', ';
}
if(isset($_GET['colore'])){
    $coloreS=$_GET['colore'];
    $Qcolore=' colore= "'.$coloreS.'" AND ';
    $testocolore='colore='.$coloreS.', ';
}
if(isset($_GET['annoFabmin'])){
    $fabminS=$_GET['annoFabmin'];
    $Qfabmin=' annoFab>='.$fabminS.' AND ';
    $testoannomin='anno min='.$fabminS.', ';
}
if(isset($_GET['annoFabmax'])){
    $fabmaxS=$_GET['annoFabmax'];
    $Qfabmax=' annoFab<='.$fabmaxS.' AND ';
    $testoannomax='anno max='.$fabmaxS.'';
    }

$filtroQuery= "$Qtipo $Qmarca $Qcolore $Qfabmin $Qfabmax" ;
$testofiltro="$testotipo $testomarca $testocolore $testoannomin $testoannomax";

if(inserisciFiltroMercatino($nickname,$filtroQuery,$testofiltro,$mysqli)==true){

    header("location: /mercatino.php");
}else{
    echo 'errore';
}