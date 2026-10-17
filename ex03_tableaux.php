<?php
// Auteur : Nadia Ouaalla
// Objectif : Manipuler les tableaux, calculer les statistiques et trier.
// Date : 16/10/2026

require_once 'config.php';
require_once 'ex02_flux.php';
require_once 'includes/entete_inc.php';
require_once 'includes/menu_inc.php';

// Exercice 3.1 : Création des tableaux
$notes = [
    "Mohamed" => 16,
    "Ahmed" => 14,
    "Hind" => 13,
    "Aicha" => 15,
    "Samir" => 13,
    "Zakaria" => 13,
    "Rafik" => 10,
    "Ilham" => 9,
    "Hamza" => 7,
    "Sami" => 7,
    "Noura" => 14
];

$modules = ["PHP", "HTML", "SQL"];

echo "<h2>Exercice 3.1 : Modules</h2>";

foreach ($modules as $module) {
    echo htmlspecialchars($module) . "<br>";
}

echo "Module 0 : " . $modules[0] . "<br>";
echo "Module 1 : " . $modules[1] . "<br>";
echo "Module 2 : " . $modules[2] . "<br>";

// Exercice 3.2 : Tableau HTML
echo "<h2>Exercice 3.2 : Notes des apprenants</h2>";

echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Nom</th><th>Note</th><th>Mention</th></tr>";

foreach ($notes as $nom => $note) {
    $couleur = ($note < SEUIL) ? "red" : "black";

    echo "<tr style='color:$couleur'>";
    echo "<td>" . htmlspecialchars($nom) . "</td>";
    echo "<td>$note</td>";
    echo "<td>" . mention($note) . "</td>";
    echo "</tr>";
}

echo "</table>";

// Exercice 3.3 : Statistiques sans array_sum()
echo "<h2>Exercice 3.3 : Statistiques</h2>";

$somme = 0;
$meilleure = null;
$faible = null;

foreach ($notes as $note) {
    $somme += $note;

    if ($meilleure === null || $note > $meilleure) {
        $meilleure = $note;
    }

    if ($faible === null || $note < $faible) {
        $faible = $note;
    }
}

$nombre = count($notes);
$moyenne = $somme / $nombre;

echo "Somme : $somme<br>";
echo "Nombre d'apprenants : $nombre<br>";
echo "Moyenne : " . round($moyenne, 2) . "<br>";
echo "Meilleure note : $meilleure<br>";
echo "Plus faible note : $faible<br>";

// Vérification avec les fonctions PHP
echo "Somme vérifiée : " . array_sum($notes) . "<br>";
echo "Nombre vérifié : " . count($notes) . "<br>";
echo "Maximum vérifié : " . max($notes) . "<br>";
echo "Minimum vérifié : " . min($notes) . "<br>";

// Effectifs par mention
$effectifs = [];

foreach ($notes as $note) {
    $m = mention($note);

    if (!isset($effectifs[$m])) {
        $effectifs[$m] = 0;
    }

    $effectifs[$m]++;
}

echo "<h3>Effectifs par mention</h3>";

foreach ($effectifs as $m => $effectif) {
    echo htmlspecialchars($m) . " : $effectif<br>";
}

// Exercice 3.4 : Fonction d'affichage
function afficher($tab) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Nom / clé</th><th>Valeur</th></tr>";

    foreach ($tab as $cle => $valeur) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars((string) $cle) . "</td>";
        echo "<td>" . htmlspecialchars((string) $valeur) . "</td>";
        echo "</tr>";
    }

    echo "</table><br>";
}

echo "<h2>Tri par noms croissants</h2>";
$tri = $notes;
ksort($tri);
afficher($tri);

echo "<h2>Tri par notes décroissantes</h2>";
$tri = $notes;
arsort($tri);
afficher($tri);

echo "<h2>Tri par noms décroissants</h2>";
$tri = $notes;
krsort($tri);
afficher($tri);

echo "<h2>Tri par notes croissantes</h2>";
$tri = $notes;
asort($tri);
afficher($tri);

// Exercice 3.5 : Opérateurs de tableaux
echo "<h2>Exercice 3.5 : Opérateurs</h2>";

$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];

echo "<pre>";
var_dump($a + $b);
var_dump($a == $b);
var_dump($a === $b);
echo "</pre>";

// Pour un tableau indexé : sort() trie les valeurs
// et réattribue des indices numériques.

require_once 'includes/pied_inc.php';