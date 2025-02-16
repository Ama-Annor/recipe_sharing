<?php

$servername = 'localhost';
$username = 'root'; //ama.annor
$password = '';  
$dbname = 'recipe_sharing'; //webtech_fall2024_ama_annor

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed");
}       




?>
