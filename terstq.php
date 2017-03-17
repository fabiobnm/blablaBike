<?php
include 'db_connect.php';
/*$con=mysqli_connect("localhost","root","nonlaso","blablabike");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql="SELECT * FROM bicicletta WHERE proprietario = 'prova'";
$result=mysqli_query($con,$sql);

echo "333";
echo "<br>";
// Numeric array
//$row=mysqli_fetch_array($result,MYSQLI_NUM);
//printf ("%s (%s)\n",$row[0],$row[1]);

// Associative array
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo $row["nome"];
     echo "<br>";
}

//printf ("%s (%s)\n",$row["nome"],$row["peso"]);

// Free result set
mysqli_free_result($result);

mysqli_close($con);
?>
*/
echo "io";
echo "<br>";

$nickname = "prova";
$query="SELECT * FROM bicicletta WHERE proprietario = '$nickname' ";
$result=mysqli_query($mysqli,$query);


while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo $row["nome"];
    echo " ";
    echo $row["ID"];
    echo " ";
    echo $row["tipo"];
    echo " ";
    echo $row["peso"];
    echo "<br>";
}

echo "sono qui ";