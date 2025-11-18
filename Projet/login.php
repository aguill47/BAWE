<?php
include('header.php');
?>
<main>
<?php
include 'connexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    $user = trim($user);

    $result = pg_query_params(
        $conn,
        "SELECT id, username, password FROM users WHERE username = $1 LIMIT 1",
        [$user]
    );

    if ($result && pg_num_rows($result) > 0) {
        $u = pg_fetch_assoc($result);

        $isValid = ($pass === $u['password']);

        if ($isValid) {
            session_regenerate_id(true);
            $_SESSION['user_id']  = $u['id'];
            $_SESSION['username'] = $u['username'];

            header('Location: index.php');
            exit;
        } else {
            $error = ($lang === 'fr') ? "Mot de passe incorrect." : "Incorrect password.";
        }
    } else {
        $error = ($lang === 'fr') ? "Utilisateur introuvable." : "User not found.";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<?php if (!empty($error)): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form class='login' method="post">
  <input type="text" name="username"
         placeholder="<?= ($lang === 'fr') ? "Nom d'utilisateur" : "Username" ?>" required><br>

  <input type="password" name="password"
         placeholder="<?= ($lang === 'fr') ? "Mot de passe" : "Password" ?>" required><br>

  <button type="submit"><?= ($lang === 'fr') ? "Connexion" : "Log in" ?></button>
</form>

</main>
<?php include('footer.php'); ?>
