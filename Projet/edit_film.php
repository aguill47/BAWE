<?php
include('connexion.php');
include('header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die(($lang === 'fr') ? "ID invalide." : "Invalid ID.");
}

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
        $error = ($lang === 'fr')
            ? "Erreur de mise à jour : " . pg_last_error($conn)
            : "Update error: " . pg_last_error($conn);
    }
}

$res = pg_query_params($conn, "SELECT * FROM film WHERE id = $1", [$id]);
if (!$res || pg_num_rows($res) === 0) {
    die(($lang === 'fr') ? "Film introuvable." : "Film not found.");
}
$film = pg_fetch_assoc($res);
?>

<h2 style="text-align:center;">
  <?= ($lang === 'fr')
    ? "Modifier le film " . htmlspecialchars($film['titre_fr'])
    : "Edit film " . htmlspecialchars($film['titre_en']) ?>
</h2>

<?php if (!empty($error)): ?>
  <p style="color:red; text-align:center;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" style="max-width:600px; margin:auto;">
  <label><?= ($lang === 'fr') ? "Titre (Français)" : "Title (French)" ?></label><br>
  <input type="text" name="titre_fr" value="<?= htmlspecialchars($film['titre_fr']) ?>" required><br><br>

  <label><?= ($lang === 'fr') ? "Titre (Anglais)" : "Title (English)" ?></label><br>
  <input type="text" name="titre_en" value="<?= htmlspecialchars($film['titre_en']) ?>" required><br><br>

  <label><?= ($lang === 'fr') ? "Description (Français)" : "Description (French)" ?></label><br>
  <textarea name="description_fr" rows="3"><?= htmlspecialchars($film['description_fr']) ?></textarea><br><br>

  <label><?= ($lang === 'fr') ? "Description (Anglais)" : "Description (English)" ?></label><br>
  <textarea name="description_en" rows="3"><?= htmlspecialchars($film['description_en']) ?></textarea><br><br>

  <label><?= ($lang === 'fr') ? "Lien YouTube (film complet)" : "YouTube link (full film)" ?></label><br>
  <input type="text" name="lien_youtube_film" value="<?= htmlspecialchars($film['lien_youtube_film']) ?>"><br><br>

  <label><?= ($lang === 'fr') ? "Lien YouTube (trailer, optionnel)" : "YouTube link (trailer, optional)" ?></label><br>
  <input type="text" name="lien_youtube_trailer" value="<?= htmlspecialchars($film['lien_youtube_trailer']) ?>"><br><br>

  <button type="submit">
    <?= ($lang === 'fr') ? "Enregistrer" : "Save" ?>
  </button>
  <a href="films.php">
    <?= ($lang === 'fr') ? "Annuler" : "Cancel" ?>
  </a>
</form>

<?php include('footer.php'); ?>
