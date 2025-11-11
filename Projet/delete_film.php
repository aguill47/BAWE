<?php
include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die("Méthode non autorisée.");
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    die("ID invalide.");
}

$ok = pg_query_params($conn, "DELETE FROM film WHERE id = $1", [$id]);

if ($ok) {
    header("Location: films.php");
    exit;
} else {
    echo "Erreur lors de la suppression : " . pg_last_error($conn);
}
