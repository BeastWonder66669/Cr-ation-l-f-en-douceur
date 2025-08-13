<?php
// Paramètres de connexion
$host = "localhost";
$dbname = "ecommerce";
$username = "root";
$password = "";

// Connexion PDO
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
