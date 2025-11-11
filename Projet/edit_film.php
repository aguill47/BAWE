<?php
include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Récupérer l'ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("ID invalide.");
}

// Si envoi du formulaire -> UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre_fr = $_POST['titre_fr'] ?? '';
    $titre_en = $_POST['titre_en'] ?? '';
    $desc_fr  = $_POST['description_fr'] ?? '';
    $desc_en  = $_POST['description_en'] ?? '';
    $lien_film    = $_POST['lien_youtube_film'] ?? '';
    $lien_trailer = $_POST['lien_youtube_trailer'] ?? null;

    $sql = "
        UPDATE film
           SET titre_fr = $1,
               titre_en = $2,
               description_fr = $3,
               description_en = $4,
               lien_youtube_film = $5,
               lien_youtube_trailer = $6
         WHERE id = $7
    ";

    $ok = pg_query_params($conn, $sql, [
        $titre_fr, $titre_en, $desc_fr, $desc_en, $lien_film, $lien_trailer, $id
    ]);

    if ($ok) {
        header("Location: films.php");
        exit;
    } else {
        $error = "Erreur de mise à jour : " . pg_last_error($conn);
    }
}

// Charger les données actuelles
$res = pg_query_params($conn, "SELECT * FROM film WHERE id = $1", [$id]);
if (!$res || pg_num_rows($res) === 0) {
    die("Film introuvable.");
}
$film = pg_fetch_assoc($res);
?>

<h2>Modifier le film #<?= htmlspecialchars($film['id']) ?></h2>
<?php if (!empty($error)): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" style="max-width:600px;">
  <label>Titre (FR)</label><br>
  <input type="text" name="titre_fr" value="<?= htmlspecialchars($film['titre_fr']) ?>" required><br><br>

  <label>Titre (EN)</label><br>
  <input type="text" name="titre_en" value="<?= htmlspecialchars($film['titre_en']) ?>" required><br><br>

  <label>Description (FR)</label><br>
  <textarea name="description_fr" rows="3"><?= htmlspecialchars($film['description_fr']) ?></textarea><br><br>

  <label>Description (EN)</label><br>
  <textarea name="description_en" rows="3"><?= htmlspecialchars($film['description_en']) ?></textarea><br><br>

  <label>Lien YouTube (film)</label><br>
  <input type="text" name="lien_youtube_film" value="<?= htmlspecialchars($film['lien_youtube_film']) ?>"><br><br>

  <label>Lien YouTube (trailer, optionnel)</label><br>
  <input type="text" name="lien_youtube_trailer" value="<?= htmlspecialchars($film['lien_youtube_trailer']) ?>"><br><br>

  <button type="submit">Enregistrer</button>
  <a href="films.php">Annuler</a>
</form>
