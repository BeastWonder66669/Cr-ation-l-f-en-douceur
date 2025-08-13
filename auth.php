<?php
session_start();
require 'db.php'; // Fichier de connexion à la base de données

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Rechercher l'admin par email
    $query = $db->prepare("SELECT * FROM admins WHERE email = ?");
    $query->execute([$email]);
    $admin = $query->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Vérification du mot de passe haché
        if (password_verify($password, $admin['password'])) {
            // Connexion réussie → enregistrer la session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];

            // Rediriger vers le tableau de bord
            header("Location: admin-dashboard.html");
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Aucun compte admin trouvé avec cet email.";
    }
}

// Si erreur → afficher message
if (!empty($error)) {
    echo "<script>alert('$error'); window.location.href='admin-login.html';</script>";
    exit;
}
?>
