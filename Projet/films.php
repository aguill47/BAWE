<?php include('header.php'); ?>
<?php include('connexion.php'); ?>

<?php
echo ($lang === 'fr')
  ? '<h2>Liste des courts-métrages</h2>'
  : '<h2>List of short films</h2>';
?>

<?php
$isLoggedIn = !empty($_SESSION['user_id']);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$result = pg_query($conn, "SELECT id, titre_fr, titre_en, description_fr, description_en, lien_youtube_film, lien_youtube_trailer FROM film ORDER BY id DESC");

while ($row = pg_fetch_assoc($result)) {
    $id = (int)$row['id'];

    $titre = ($lang === 'fr') ? $row['titre_fr'] : $row['titre_en'];
    $desc  = ($lang === 'fr') ? $row['description_fr'] : $row['description_en'];

    $lienFilm = $row['lien_youtube_film'] ?? '';
    $lienTrailer = $row['lien_youtube_trailer'] ?? '';

    function toEmbedUrl($url) {
        if (strpos($url, 'youtu.be/') !== false) {
            return str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
        }
        if (strpos($url, 'watch?v=') !== false) {
            return str_replace('watch?v=', 'embed/', $url);
        }
        return $url; 
    }

    $embedFilm = toEmbedUrl($lienFilm);
    $embedTrailer = toEmbedUrl($lienTrailer);

    echo "<div class='film' style='padding:12px; margin:10px 0;'>";
    echo "<h3>" . htmlspecialchars($titre) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($desc)) . "</p>";

    if (!empty($embedFilm)) {
        echo "<div class='video-wrapper' style='margin-top:10px;'>";
        echo "<iframe width='560' height='315' src='" . htmlspecialchars($embedFilm) . "' title='YouTube video player' frameborder='0' allowfullscreen></iframe>";
        echo "</div>";
    }

    if (!empty($embedTrailer)) {
        echo "<div class='video-wrapper' style='margin-top:10px;'>";
        echo "<iframe width='560' height='315' src='" . htmlspecialchars($embedTrailer) . "' title='Trailer' frameborder='0' allowfullscreen></iframe>";
        echo "</div>";
    }

    if ($isLoggedIn) {
        echo "<span class='btn_film'>";
        echo "<a href='edit_film.php?id={$id}'>" . (($lang === 'fr') ? "Modifier" : "Edit") . "</a> &nbsp;|&nbsp; ";
        echo "<form action='delete_film.php' method='post' style='display:inline' onsubmit=\"return confirm('" . (($lang === 'fr') ? "Supprimer ce film ?" : "Delete this film?") . "');\">";
        echo "<input type='hidden' name='id' value='{$id}'>";
        echo "<button type='submit'>" . (($lang === 'fr') ? "Supprimer" : "Delete") . "</button>";
        echo "</form>";
        echo "</span>";
    }

    echo "</div>";
}
?>



<!-- <?php include('includes/footer.php'); ?> -->
