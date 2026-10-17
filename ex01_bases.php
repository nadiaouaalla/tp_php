<?php
//commentaire sur une ligne
#un autre commentaire sur une ligne
/*commentaire sur plusieurs lignes
*/
echo 'Hello PHP';
// Exercice 1.1 : Noms de variables

// $x : valide, commence par une lettre.
$x = 10;

// $_x : valide, commence par un underscore.
$_x = 20;

// $2x : invalide, commence par un chiffre.

// $x-y : invalide, le tiret n'est pas autorisé.

// $Prix_HT : valide, contient des lettres et underscore.
$Prix_HT = 100;

// $prix ht : invalide, contient un espace.

// $état : valide en PHP 8, identifiant UTF-8.
$état = "valide";

// $a et $A sont deux variables distinctes.
$a = 1;
$A = 2;

echo "<br>Valeur de a : " . $a;
echo "<br>Valeur de A : " . $A;
// Exercice 1.2 : Constantes

require 'config.php';

echo "<hr>";
echo "<h3>Exercice 1.2 : Constantes</h3>";

echo "Etablissement : " . ETABLISSEMENT . "<br>";
echo "Note minimale : " . NOTE_MIN . "<br>";
echo "Note maximale : " . NOTE_MAX . "<br>";
echo "Seuil : " . SEUIL . "<br>";

var_dump(defined('SEUIL'));
echo "<br>";
var_dump(defined('INCONNUE'));

// Si une constante non définie est utilisée,
// PHP peut afficher un avertissement ou une erreur.
// const déclare une constante à la compilation,
// tandis que define() la définit pendant l'exécution.
// Exercice 1.3 : Calcul

$prix_ht = 60;
$tva = 20;

$prix_ttc = $prix_ht + ($prix_ht * $tva / 100);

echo "<hr>";
echo "Le prix TTC du produit est de " . $prix_ttc . " €.";
// Exercice 1.4 : Types et conversions

// Question 1
$test = 42;
$test = (string) $test;

echo "<hr><h3>Exercice 1.4 : Types et conversions</h3>";
var_dump($test);
// Question 2 : Conversion en booléen

echo "<h4>Question 2 : Conversion en booléen</h4>";

var_dump((bool) 0);
echo "<br>";

var_dump((bool) 0.0);
echo "<br>";

var_dump((bool) "0");
echo "<br>";

var_dump((bool) "");
echo "<br>";

var_dump((bool) "abc");
echo "<br>";

var_dump((bool) []);
echo "<br>";

var_dump((bool) null);
echo "<br>";
// Question 3 : Conversions

echo "<h4>Question 3 : Conversions</h4>";

var_dump((int) 3.9);
echo "<br>";

var_dump((int) "12abc");
echo "<br>";

var_dump((float) "1.5e3");
echo "<br>";

var_dump((int) true);
echo "<br>";
// Question 4 : Nombre 255 dans différentes bases

echo "<h4>Question 4 : Nombre 255</h4>";

$decimal = 255;
$hexadecimal = dechex(255);
$octal = decoct(255);
$binaire = decbin(255);

echo "Décimal : " . $decimal . "<br>";
echo "Hexadécimal : " . $hexadecimal . "<br>";
echo "Octal : " . $octal . "<br>";
echo "Binaire : " . $binaire . "<br>";
// Exercice 1.5 : Chaînes de caractères

echo "<hr><h3>Exercice 1.5 : Chaînes de caractères</h3>";

$traitees = "égales à";
$ici = 2;

// 1. Guillemets simples et doubles
echo 'Ahmed a dit : "J\'ai réussi"';
echo "<br>";

// 2. Antislashs
echo 'Voulez-vous supprimer C:\*.*?';
echo "<br>";

// 3. Afficher \n tel quel
echo 'Ceci n\'affichera pas \n de nouvelle ligne';
echo "<br>";

// 4. Variables non interprétées
echo 'Les variables ne seront pas $traitees $ici';
echo "<br>";

// 5. Variables interprétées
echo "Les variables seront $traitees $ici";
echo "<br>";
// Suppression des étoiles avec trim()

$texte = "*Bonjour les développeurs*";
$texte_nettoye = trim($texte, "*");

echo "<h4>Utilisation de trim()</h4>";
echo $texte_nettoye;
echo "<br>";
// Afficher chaque caractère sur une ligne

echo "<h4>Affichage de chaque caractère</h4>";

$mot = "PHP";

for ($i = 0; $i < strlen($mot); $i++) {
    echo $mot[$i] . "<br>";
}
?>