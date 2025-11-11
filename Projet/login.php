<?php include('header.php'); ?>

<?php
include 'connexion.php'; // doit définir $conn (pg_connect)

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Optionnel : nettoyage basique
    $user = trim($user);

    // On ne sélectionne que ce qui est nécessaire
    $result = pg_query_params(
        $conn,
        "SELECT id, username, password FROM users WHERE username = $1 LIMIT 1",
        [$user]
    );

    if ($result && pg_num_rows($result) > 0) {
        $u = pg_fetch_assoc($result);

        // Si tes mots de passe sont HASHÉS (recommandé) :
        // $isValid = password_verify($pass, $u['password']);

        // Si ce n'est PAS hashé (comme ton code actuel) :
        $isValid = ($pass === $u['password']);

        if ($isValid) {
            // Sécurise la session
            session_regenerate_id(true);
            $_SESSION['user_id']  = $u['id'];
            $_SESSION['username'] = $u['username'];

            header('Location: index.php');
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur introuvable.";
    }
}
?>

<?php if (!empty($error)): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
  <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
  <input type="password" name="password" placeholder="Mot de passe" required><br>
  <button type="submit">Connexion</button>
</form>
