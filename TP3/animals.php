<?php

$animals = array(
    "Lion" => array(
        "latin_name" => "Panthera leo",
        "wikipedia" => "https://fr.wikipedia.org/wiki/Lion",
        "is_large" => true,
        "comment" => "Le lion est un grand félin connu pour sa majesté et sa force."
    ),
    "Elephant" => array(
        "latin_name" => "Loxodonta africana",
        "wikipedia" => "https://fr.wikipedia.org/wiki/%C3%89l%C3%A9phant_d%27Afrique",
        "is_large" => true,
        "comment" => "L'éléphant est l'un des plus grands animaux terrestres, reconnu pour sa mémoire et son intelligence."
    ),
    "Colibri" => array(
        "latin_name" => "Trochilidae",
        "wikipedia" => "https://fr.wikipedia.org/wiki/Colibri",
        "is_large" => false,
        "comment" => "Le colibri est un petit oiseau, célèbre pour sa capacité à voler sur place."
    ),
    "Dauphin" => array(
        "latin_name" => "Delphinus delphis",
        "wikipedia" => "https://fr.wikipedia.org/wiki/Dauphin",
        "is_large" => false,
        "comment" => "Les dauphins sont des mammifères marins intelligents et sociaux."
    ),
    "Tigre" => array(
        "latin_name" => "Panthera tigris",
        "wikipedia" => "https://fr.wikipedia.org/wiki/Tigre",
        "is_large" => true,
        "comment" => "Le tigre est un prédateur solitaire, symbole de puissance et de beauté sauvage."
    )
);


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