<?php
// Auteur : Nadia Ouaalla
// Objectif : Traiter le formulaire GET.
// Date : 16/10/2026

$nom = trim($_GET['nom'] ?? '');
$prenom = trim($_GET['prenom'] ?? '');
$sexe = $_GET['sexe'] ?? '';

if ($nom === '' || $prenom === '' ||
    !in_array($sexe, ['M', 'F'], true)) {
    exit("Veuillez remplir correctement le formulaire.");
}

$civilite = ($sexe === 'M') ? "Monsieur" : "Madame";

echo "Bonjour " . $civilite . " "
    . htmlspecialchars($prenom) . " "
    . htmlspecialchars($nom);