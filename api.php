<?php
header('Content-Type: application/json');

// Autoriser l'accès depuis un domaine spécifique
header('Access-Control-Allow-Origin: https://melun-voyage.netlify.app');
// Autoriser les méthodes GET et POST
header('Access-Control-Allow-Methods: GET, POST');
// Autoriser le contenu avec les en-têtes Content-Type spécifiés
header('Access-Control-Allow-Headers: Content-Type');

// Étape 2 : Inclure le fichier de connexion
require_once __DIR__ . '/connexion.php';


// Connexion à la base de données
$dbname = "darras_reservation";
$servername = "mysql-darras.alwaysdata.net";
$username = "darras";
$password = "Lo200177";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Erreur de connexion à la base de données : " . $con->connect_error);
}

// Récupérer toutes les réservations
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = $con->query("SELECT * FROM reservation");

    if ($query) {
        $reservations = [];
        while ($row = $query->fetch_assoc()) {
            $reservations[] = $row;
        }

        $response['error'] = false;
        $response['reservations'] = $reservations;
        $response['message'] = 'La récupération des réservations a réussi.';
    } else {
        $response['error'] = true;
        $response['message'] = 'Échec de la récupération des réservations.';
    }

    echo json_encode($response);
}

// Récupérer une réservation par nom
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $query = $con->prepare("SELECT * FROM reservation WHERE nom = ?");
    $query->bind_param("s", $nom);

    if ($query->execute()) {
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $reservation = $result->fetch_assoc();
            $response['error'] = false;
            $response['reservation'] = $reservation;
            $response['message'] = 'La récupération de la réservation par nom a réussi.';
        } else {
            $response['error'] = true;
            $response['message'] = 'Aucune réservation trouvée avec ce nom.';
        }
    } else {
        $response['error'] = true;
        $response['message'] = 'Échec de la récupération de la réservation par nom.';
    }

    echo json_encode($response);
}

$con->close();
?>
