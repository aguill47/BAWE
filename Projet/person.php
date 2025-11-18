<?php include('header.php'); ?>
<main>
<?php
echo ($lang === 'fr')
  ? '<h2>Les réalisateurs & contributeurs</h2>
     <p>Ces passionnés participent activement à la création ou à la diffusion des courts-métrages sur la plateforme.</p>'
  : '<h2>Directors & Contributors</h2>
     <p>These passionate people are actively involved in the creation or promotion of the short films on this platform.</p>';
?>

<section class="contributors">
  <div class="contributor-card">
    <h3>Camille Dubois</h3>
    <p><?= ($lang === 'fr') 
        ? "Réalisatrice indépendante basée à Lyon. Spécialisée dans les films poétiques et engagés." 
        : "Independent filmmaker based in Lyon. Specializes in poetic and socially engaged films." ?></p>
  </div>

  <div class="contributor-card">
    <h3>Thomas Leroy</h3>
    <p><?= ($lang === 'fr') 
        ? "Technicien son et monteur vidéo, il participe à plusieurs projets amateurs depuis 2020." 
        : "Sound technician and video editor, active in various indie projects since 2020." ?></p>
  </div>

  <div class="contributor-card">
    <h3>Élise Moreau</h3>
    <p><?= ($lang === 'fr') 
        ? "Scénariste passionnée, elle aime écrire des histoires courtes à forte dimension humaine." 
        : "Passionate screenwriter, she enjoys crafting short stories with a strong human focus." ?></p>
  </div>
</section>
</main>

<?php include('footer.php'); ?>
