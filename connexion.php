

<?php
// Connexion à la base de données
$dbname = "darras_reservation";
$servername = "mysql-darras.alwaysdata.net";
$username = "darras@2a00:b6e0:1:210:1::1";
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