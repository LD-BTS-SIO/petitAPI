<?php
// Connexion à la base de données
$dbname = "darras_reservation";
$servername = "mysql-darras.alwaysdata.net";
$port = 3306; // Remplacez par le port approprié
$username = "darras";
$password = "Lo200177";

try {
    $con = new mysqli($servername, $username, $password, $dbname, $port);
    if ($con->connect_error) {
        throw new Exception("Impossible de se connecter à la base de données : " . $con->connect_error);
    }
    echo "Connexion effectuée avec succès!";
} catch (Exception $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
?>
