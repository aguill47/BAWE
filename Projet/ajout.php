<?php
include('config.php'); 
include('connexion.php'); 
include('header.php'); 

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Accès refusé. Vous devez être administrateur.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $desc = $_POST['description'];
    $link = $_POST['lien'];

    // Préparer la requête
    $query = "INSERT INTO film (titre, description, lien) VALUES ($1, $2, $3)";
    $result = pg_prepare($conn, "insert_film", $query);

    if ($result) {
        $exec = pg_execute($conn, "insert_film", array($titre, $desc, $link));
        if ($exec) {
            echo "<p>Court-métrage ajouté avec succès !</p>";
        } else {
            echo "<p>Erreur lors de l'ajout du court-métrage.</p>";
        }
    } else {
        echo "<p>Erreur lors de la préparation de la requête.</p>";
    }
}
?>

<form method="post">
  <input type="text" name="titre" placeholder="Titre" required><br>
  <textarea name="description" placeholder="Description"></textarea><br>
  <input type="text" name="lien" placeholder="Lien"><br>
  <button type="submit">Ajouter</button>
</form>
