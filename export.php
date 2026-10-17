<?php
// Auteur : Nadia Ouaalla
// Objectif : Exporter les résultats au format JSON et comparer la sérialisation.
// Date : 16/10/2026

require_once 'config.php';
require_once 'ex02_flux.php';
require_once 'includes/entete_inc.php';
require_once 'includes/menu_inc.php';

$fichier_csv = __DIR__ . '/data/notes.csv';
$fichier_json = __DIR__ . '/data/notes.json';

$resultats = [];

if (file_exists($fichier_csv)) {
    $handle = fopen($fichier_csv, 'r');

    if ($handle === false) {
        exit("Impossible d'ouvrir le fichier CSV.");
    }

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

        $resultats[] = [
            'nom' => $nom,
            'note_info' => $info,
            'note_math' => $math,
            'moyenne' => round($moyenne, 2)
        ];
    }

    fclose($handle);
} else {
    echo "<p>Le fichier CSV n'existe pas encore.</p>";
}

$json = json_encode(
    $resultats,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
);

if ($json === false) {
    exit("Erreur lors de la conversion en JSON.");
}

if (file_put_contents($fichier_json, $json) === false) {
    exit("Erreur lors de l'écriture du fichier JSON.");
}

echo "<h2>Contenu relu depuis le fichier JSON</h2>";

$json_lu = file_get_contents($fichier_json);
$donnees = json_decode($json_lu, true);

echo "<pre>";
print_r($donnees);
echo "</pre>";

// Comparaison de serialize() et json_encode()
$exemple = [
    'nom' => 'Nadia',
    'notes' => [15, 18],
    'moyenne' => 16.5
];

echo "<h2>Résultat de serialize()</h2>";
echo "<pre>" . htmlspecialchars(serialize($exemple)) . "</pre>";

echo "<h2>Résultat de json_encode()</h2>";
echo "<pre>" . htmlspecialchars(
    json_encode($exemple, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
) . "</pre>";

require_once 'includes/pied_inc.php';