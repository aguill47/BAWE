<?php
session_start(); // ← Obligatoire pour accéder à $_SESSION
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Red Poppy</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <a href="index.php">Accueil</a> |
      <a href="films.php">Courts métrages</a> |
      <a href="person.php">Réalisateurs</a>
      
      <?php if (isset($_SESSION['user_id'])): ?>
        | <a href="ajout.php">Ajouter un film</a>
        | <a href="logout.php">Déconnexion (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
      <?php else: ?>
        | <a href="login.php">Connexion</a>
      <?php endif; ?>
    </nav>
    <hr>
  </header>

