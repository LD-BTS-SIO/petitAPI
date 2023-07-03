<?php
$servername = "phpmyadmin.alwaysdata.com";
$username = "root";
$password = "Lo200177";
$dbname = "darras_reservation";

// Établir la connexion
$con = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($con->connect_error) {
    die("Erreur de connexion à la base de données : " . $con->connect_error);
}
?>