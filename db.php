<?php
$servername = "localhost";   
$username = "root";          
$password = "";               
$dbname = "employee_management";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error . " - Code d'erreur: " . $conn->connect_errno);
}
?>
