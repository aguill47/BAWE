<?php
include('connexion.php'); 
include('header.php'); 


if (!isset($_SESSION['user_id'])) {
    echo "<p>Accès refusé. Vous devez être administrateur.</p>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des valeurs envoyées par le formulaire
    $titre_fr = $_POST['titre_fr'] ?? '';
    $titre_en = $_POST['titre_en'] ?? '';
    $desc_fr  = $_POST['description_fr'] ?? '';
    $desc_en  = $_POST['description_en'] ?? '';
    $film_link = $_POST['lien_film'] ?? '';
    $trailer_link = $_POST['lien_trailer'] ?? null; // trailer facultatif

    // Préparer la requête d’insertion
    $query = "
        INSERT INTO film (
            titre_fr, titre_en,
            description_fr, description_en,
            lien_youtube_film, lien_youtube_trailer
        ) VALUES ($1, $2, $3, $4, $5, $6)
    ";

    // Préparer la requête nommée
    $result = pg_prepare($conn, "insert_film", $query);

    if ($result) {
        // Exécuter la requête avec les valeurs du formulaire
        $exec = pg_execute($conn, "insert_film", [
            $titre_fr,
            $titre_en,
            $desc_fr,
            $desc_en,
            $film_link,
            $trailer_link
        ]);

        if ($exec) {
    echo ($lang === 'fr')
        ? "<p style='color:green;'>🎬 Court-métrage ajouté avec succès !</p>"
        : "<p style='color:green;'>🎬 Short film added successfully!</p>";
} else {
    echo ($lang === 'fr')
        ? "<p style='color:red;'>Erreur lors de l'ajout du court-métrage : " . pg_last_error($conn) . "</p>"
        : "<p style='color:red;'>Error while adding the short film: " . pg_last_error($conn) . "</p>";
}
} else {
    echo ($lang === 'fr')
        ? "<p style='color:red;'>Erreur lors de la préparation de la requête.</p>"
        : "<p style='color:red;'>Error while preparing the query.</p>";
}

}
?>

<?php
echo ($lang === 'fr')
  ? '
  <h2>Ajouter un court-métrage</h2>
  <form method="post" style="max-width:500px;">
    <label>Titre (Français)</label><br>
    <input type="text" name="titre_fr" placeholder="Titre en français" required><br><br>

    <label>Titre (Anglais)</label><br>
    <input type="text" name="titre_en" placeholder="Titre en anglais" required><br><br>

    <label>Description (Français)</label><br>
    <textarea name="description_fr" placeholder="Description en français" rows="3"></textarea><br><br>

    <label>Description (Anglais)</label><br>
    <textarea name="description_en" placeholder="Description en anglais" rows="3"></textarea><br><br>

    <label>Lien YouTube (film complet)</label><br>
    <input type="text" name="lien_film" placeholder="https://youtu.be/..." required><br><br>

    <label>Lien YouTube (trailer, optionnel)</label><br>
    <input type="text" name="lien_trailer" placeholder="https://youtu.be/..."><br><br>

    <button type="submit">Ajouter</button>
  </form>
  '
  : '
  <h2>Add a short film</h2>
  <form method="post" style="max-width:500px;">
    <label>Title (French)</label><br>
    <input type="text" name="titre_fr" placeholder="Title in French" required><br><br>

    <label>Title (English)</label><br>
    <input type="text" name="titre_en" placeholder="Title in English" required><br><br>

    <label>Description (French)</label><br>
    <textarea name="description_fr" placeholder="Description in French" rows="3"></textarea><br><br>

    <label>Description (English)</label><br>
    <textarea name="description_en" placeholder="Description in English" rows="3"></textarea><br><br>

    <label>YouTube link (full film)</label><br>
    <input type="text" name="lien_film" placeholder="https://youtu.be/..." required><br><br>

    <label>YouTube link (trailer, optional)</label><br>
    <input type="text" name="lien_trailer" placeholder="https://youtu.be/..."><br><br>

    <button type="submit">Add</button>
  </form>
  ';
?>
