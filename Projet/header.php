<?php
session_start(); // ← Obligatoire pour accéder à $_SESSION

if (isset($_GET['lang']) && in_array($_GET['lang'], ['fr', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'fr';

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
      <?php
// On suppose que $lang est déjà défini avant (depuis la session)
?>

<?php
if ($lang === 'fr') {
    echo '
    <a href="index.php">Accueil</a> |
    <a href="films.php">Courts métrages</a> |
    <a href="person.php">Réalisateurs</a>
    ';
    if (isset($_SESSION["user_id"])) {
        echo ' | <a href="ajout.php">Ajouter un court métrage</a>
               | <a href="login.php?action=logout">Déconnexion (' . htmlspecialchars($_SESSION["username"]) . ')</a>';
    } else {
        echo ' | <a href="login.php">Connexion</a>';
    }
} else {
    echo '
    <a href="index.php">Home</a> |
    <a href="films.php">Short films</a> |
    <a href="person.php">Directors</a>
';

if (isset($_SESSION["user_id"])) {
    echo ' | <a href="ajout.php">Add a short film</a>
           | <a href="login.php?action=logout">Logout (' . htmlspecialchars($_SESSION["username"]) . ')</a>';
} else {
    echo ' | <a href="login.php">Login</a>';
}
}
?>

      <?php if ($lang === 'fr'): ?>
        <a href="?lang=en">🇬🇧 English</a>
    <?php else: ?>
        <a href="?lang=fr">🇫🇷 Français</a>
    <?php endif; ?>
        
    <button id="theme-toggle" title="Changer de thème">🌙</button>

    </nav>
  </header>

  <script src="js/theme.js"></script>


