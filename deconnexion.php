<?php
// Auteur : Nadia Ouaalla
// Objectif : Déconnecter l'utilisateur et détruire sa session.
// Date : 16/10/2026

session_start();

session_unset();
session_destroy();

header('Location: login.php');
exit;