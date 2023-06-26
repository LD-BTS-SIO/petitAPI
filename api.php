<?php
header('Content-Type: application/json');

// Connexion à la base de données
$servername = "phpmyadmin.alwaysdata.com";
$username = "root";
$password = "Lo200177";
$dbname = "darras_reservation";

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
