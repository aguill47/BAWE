<?php
session_start(); // obligatoire ici aussi !

// après avoir vérifié les identifiants
$_SESSION['user_id'] = $u['id'];
$_SESSION['username'] = $u['username'];



include('config.php');
include('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Requête sécurisée avec paramètres
    $result = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", array($user));

    if ($result && pg_num_rows($result) > 0) {
        $u = pg_fetch_assoc($result);

        // Mot de passe en clair : on compare directement
        if ($pass === $u['password']) {
            $_SESSION['user_id'] = $u['id'];
            $_SESSION['username'] = $u['username'];
            header("Location: index.php");
            exit;
        } else {
            echo "<p> Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p> Utilisateur introuvable.</p>";
    }
}
?>

<form method="post">
  <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
  <input type="password" name="password" placeholder="Mot de passe" required><br>
  <button type="submit">Connexion</button>
</form>

