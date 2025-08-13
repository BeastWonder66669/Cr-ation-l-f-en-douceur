<?php
session_start();

// Vérifie si l'admin est connecté
if (!isset($_SESSION['admin_id'])) {
    // Si non connecté → redirection vers la page de login
    header("Location: admin-login.html");
    exit;
}
?>
