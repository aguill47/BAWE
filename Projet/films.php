<?php include('config.php'); ?>
<?php include('header.php'); ?>
<?php include('connexion.php'); ?>



<h2>Liste des courts métrages</h2>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$result = pg_query($conn, "SELECT * FROM film");

while ($row = pg_fetch_assoc($result)) {
    echo "<div class='film'>";
    echo "<h3>" . htmlspecialchars($row['titre']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    echo "</div>";
}

?>


<!-- <?php include('includes/footer.php'); ?> -->
