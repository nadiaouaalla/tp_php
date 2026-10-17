<?php
// Auteur : Nadia Ouaalla
// Objectif : Valider les notes et les enregistrer dans un fichier CSV.
// Date : 16/10/2026

require_once 'config.php';
require_once 'ex02_flux.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Veuillez utiliser le formulaire de saisie.");
}

if (
    !isset($_POST['nom'], $_POST['note_info'], $_POST['note_math']) ||
    trim($_POST['nom']) === '' ||
    $_POST['note_info'] === '' ||
    $_POST['note_math'] === ''
) {
    exit("Erreur : tous les champs sont obligatoires.");
}

$nom = trim($_POST['nom']);

if (!is_numeric($_POST['note_info']) ||
    !is_numeric($_POST['note_math'])) {
    exit("Erreur : les notes doivent être numériques.");
}

$note_info = (float) $_POST['note_info'];
$note_math = (float) $_POST['note_math'];

if (
    $note_info < NOTE_MIN || $note_info > NOTE_MAX ||
    $note_math < NOTE_MIN || $note_math > NOTE_MAX
) {
    exit("Erreur : les notes doivent être comprises entre 0 et 20.");
}

$moyenne = ($note_info + $note_math) / 2;
$mention_finale = mention($moyenne);

$nom_affiche = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');

echo "<h1>Récapitulatif</h1>";
echo "Nom : $nom_affiche<br>";
echo "Note informatique : $note_info<br>";
echo "Note mathématiques : $note_math<br>";
echo "Moyenne : " . number_format($moyenne, 2, '.', '') . "<br>";
echo "Mention : " . htmlspecialchars($mention_finale) . "<br>";

// Création du dossier data s'il n'existe pas
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0775, true);
}

$fichier = fopen(__DIR__ . '/data/notes.csv', 'a');

if ($fichier === false) {
    exit("Erreur : impossible d'ouvrir le fichier CSV.");
}

fputcsv(
    $fichier,
    [$nom, $note_info, $note_math],
    ';',
    '"',
    ''
);

fclose($fichier);

echo "<p>Les notes ont été enregistrées avec succès.</p>";
echo '<a href="liste.php">Voir la liste des notes</a>';