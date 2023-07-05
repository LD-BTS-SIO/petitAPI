

<?php
// Connexion à la base de données
$dbname = "darras_reservation";
$servername = "mysql-darras.alwaysdata.net";
$username = "darras";
$password = "Lo200177";

$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérification
if (!$con) {
    echo "Message : Impossible de se connecter à la BD";
die();
} else {
    echo "Connexion effectuée avec succès!";
}

?>