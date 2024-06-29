<?php
$host="localhost:3306";
$dbname="majkelj";
$username="majkelj";
$password="zaq1@WSX";

$mysqli=new mysqli($host,$username,$password,$dbname);

if($mysqli->connect_errno){
    die("Błąd połączenia: ".$mysqli->connect_error);
}
return $mysqli;
$mysqli->query("SET time_zone = 'Europe/Warsaw'");
