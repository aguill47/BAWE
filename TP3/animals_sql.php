<?php

include("connexion.php");

$animals = array();

$result = pg_query($conn, "SELECT * FROM animals");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  // row[0] key
  // row[1-4] array
  $animals[$row[0]] = array($row[1], $row[2], $row[3], $row[4]);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Page PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Liste des Animaux</h1>

    <!-- Liste des animaux -->
    <ul class="animal-list">
        <?php foreach ($animals as $name => $info): ?>
            <li><a href="#<?php echo strtolower($name); ?>"><?php echo $name; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <!-- Séparateur et espace vide -->
    <div class="separator"></div>
    <div class="spacer"></div>

    <!-- Tableau des animaux -->
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nom Latin</th>
                <th>Wikipedia</th>
                <th>Taille ?</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animals as $name => $info): ?>
                <tr id="<?php echo strtolower($name); ?>">
                    <td><?php echo $name; ?></td>
                    <td><?php echo $info['latin_name']; ?></td>
                    <td><a href="<?php echo $info['wikipedia']; ?>" target="_blank">Voir sur Wikipedia</a></td>
                    <td><?php echo $info['is_large'] ? 'Gros' : 'Petit'; ?></td>
                    <td><?php echo $info['comment']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>