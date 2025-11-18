<?php include('connexion.php'); ?>
<?php include('header.php'); ?>

<main>
  <?php
  echo ($lang === 'fr')
    ? "<h1>Bienvenue sur le site !</h1>"
    : "<h1>Welcome to the website!</h1>";

  echo ($lang === 'fr')
    ? "<p style='text-align:center;'>Découvrez des courts-métrages réalisés par des passionnés.</p>"
    : "<p style='text-align:center;'>Discover short films created by passionate filmmakers.</p>";

  echo "<hr style='margin:40px 0;'>";

  // 🔹 Récupération du dernier court-métrage
  $result = pg_query($conn, "SELECT * FROM film ORDER BY id DESC LIMIT 1");

  if ($result && pg_num_rows($result) > 0) {
      $film = pg_fetch_assoc($result);

      $titre = ($lang === 'fr') ? $film['titre_fr'] : $film['titre_en'];
      $desc  = ($lang === 'fr') ? $film['description_fr'] : $film['description_en'];

      // Conversion du lien YouTube en version "embed"
      function toEmbedUrl($url) {
          if (strpos($url, 'youtu.be/') !== false) {
              return str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
          }
          if (strpos($url, 'watch?v=') !== false) {
              return str_replace('watch?v=', 'embed/', $url);
          }
          return $url;
      }

      $embedFilm = toEmbedUrl($film['lien_youtube_film'] ?? '');
      ?>

      <h2><?= ($lang === 'fr') ? "Notre dernier court-métrage !" : "Our latest short film" ?></h2>
      <section class="film">
        

        <div>
          <h3><?= htmlspecialchars($titre) ?></h3>
          <p><?= nl2br(htmlspecialchars($desc)) ?></p>

          <?php if (!empty($embedFilm)): ?>
            <div class="video-wrapper">
              <iframe width='560' height='315' src="<?= htmlspecialchars($embedFilm) ?>" title="YouTube video"
                frameborder="0" allowfullscreen></iframe>
            </div>
          <?php endif; ?>
        </div>

        <div style="text-align:center; margin-top:20px;">
          <a href="films.php" class="see-more">
            <?= ($lang === 'fr') ? "Voir les autres courts-métrages" : "See more short films" ?>
          </a>
        </div>
      </section>

  <?php
  } else {
      echo "<p style='text-align:center;'>Aucun film disponible pour le moment.</p>";
  }
  ?>
</main>

<?php include('footer.php'); ?>
