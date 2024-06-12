<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ressources/library/databaseFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ressources/templates/header.php';

$recipeId = isset($_GET['id']) ? $_GET['id'] : die('ID de la recette non spécifié.');
$recipe = getPost($recipeId);

if ($recipe) {
    echo '<h1>' . htmlspecialchars($recipe['name']) . '</h1>';
    echo '<p>' . htmlspecialchars($recipe['description']) . '</p>';
    echo '<h2> Ingrédients </h2>';
    echo '<ul>';

    $ingredients = explode(";", $recipe['ingredients']);
    foreach ($ingredients as $ingredient) {
        echo '<li>' . htmlspecialchars($ingredient) . '</li>';
    }

    echo '</ul>';
    echo "<h2>Étapes de préparation</h2>";

    if ($recipe['link']){
        echo "<iframe width=\"560\" height=\"315\" src=\"" . htmlspecialchars($recipe['link']) . "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>";
    }

    echo "<ul>";

    if (isset($recipe['steps'])) {
        $steps = explode(";", $recipe['steps']);
        foreach ($steps as $step) {
            echo '<li>' . htmlspecialchars($step) . '</li>';
        }
    }

    echo "</ul>";
    
} else {
    echo "<p>Recette introuvable.</p>";
}

include 'templates/footer.php';
?>
