<?php include('config.php'); ?>
<?php include('header.php'); ?>

<?php
echo ($lang === 'fr')
  ? "<h1>Bienvenue sur le site !</h1>"
  : "<h1>Welcome to the website!</h1>";

echo ($lang === 'fr')
  ? "<p>Découvrez et partagez des courts-métrages réalisés par des passionnés.</p>"
  : "<p>Discover and share short films created by passionate filmmakers.</p>";
?>

<?php
echo ($lang === 'fr')
  ? '<a href="films.php">Voir les courts-métrages</a>'
  : '<a href="films.php">View short films</a>';
?>

<!-- <?php include('includes/footer.php'); ?> -->
