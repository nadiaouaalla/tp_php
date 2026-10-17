<?php
// Auteur : Nadia Ouaalla
// Objectif : Lire le fichier CSV et afficher les résultats.
// Date : 16/10/2026

require_once 'config.php';
require_once 'ex02_flux.php';
require_once 'includes/entete_inc.php';
require_once 'includes/menu_inc.php';

$fichier = __DIR__ . '/data/notes.csv';

echo "<h2>Liste des notes</h2>";

if (!file_exists($fichier)) {
    echo "Aucun fichier de notes trouvé.";
    require_once 'includes/pied_inc.php';
    exit;
}

$handle = fopen($fichier, 'r');

if ($handle === false) {
    echo "Erreur : impossible d'ouvrir le fichier.";
    require_once 'includes/pied_inc.php';
    exit;
}

$somme_moyennes = 0;
$nombre = 0;

echo "<table border='1' cellpadding='6'>";
echo "<tr>
        <th>Nom</th>
        <th>Info</th>
        <th>Math</th>
        <th>Moyenne</th>
        <th>Mention</th>
      </tr>";

while (($ligne = fgetcsv($handle, 0, ';', '"', '')) !== false) {
    if (count($ligne) < 3) {
        continue;
    }

    [$nom, $info, $math] = $ligne;

    if (!is_numeric($info) || !is_numeric($math)) {
        continue;
    }

    $info = (float) $info;
    $math = (float) $math;
    $moyenne = ($info + $math) / 2;

    echo "<tr>";
    echo "<td>" . htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>$info</td>";
    echo "<td>$math</td>";
    echo "<td>" . number_format($moyenne, 2, '.', '') . "</td>";
    echo "<td>" . htmlspecialchars(mention($moyenne)) . "</td>";
    echo "</tr>";

    $somme_moyennes += $moyenne;
    $nombre++;
}

echo "</table>";

if ($nombre > 0) {
    $moyenne_classe = $somme_moyennes / $nombre;

    echo "<p>Moyenne générale de la classe : "
        . number_format($moyenne_classe, 2, '.', '')
        . "</p>";
} else {
    echo "<p>Aucune note valide dans le fichier.</p>";
}

fclose($handle);

// Exercice 5.3 : Lecture bas niveau avec fgets()
echo "<h2>Lecture avec fgets() et explode()</h2>";

$handle = fopen($fichier, 'r');

if ($handle !== false) {
    while (!feof($handle)) {
        $ligne = fgets($handle);

        if ($ligne !== false) {
            $elements = explode(';', trim($ligne));
            echo "<pre>";
            print_r($elements);
            echo "</pre>";
        }
    }

    fclose($handle);
}

require_once 'includes/pied_inc.php';