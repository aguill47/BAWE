<?php include('connexion.php'); ?>
<?php include('header.php'); ?>

<?php
echo ($lang === 'fr')
  ? "<h1>Bienvenue sur le site !</h1>"
  : "<h1>Welcome to the website!</h1>";

echo ($lang === 'fr')
  ? "<p>Découvrez et partagez des courts-métrages réalisés par des passionnés.</p>"
  : "<p>Discover and share short films created by passionate filmmakers.</p>";
?>



<!-- <?php include('includes/footer.php'); ?> -->
