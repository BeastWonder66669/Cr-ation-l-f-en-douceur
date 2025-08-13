<?php require 'check-login.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de bord - Admin</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <div class="admin-container">
    <!-- Menu latéral -->
    <aside class="sidebar">
      <h2>Mon Admin</h2>
      <nav>
        <a href="admin-dashboard.php">🏠 Tableau de bord</a>
        <a href="admin-produits.php">📦 Produits</a>
        <a href="admin-commandes.php">🛒 Commandes</a>
        <a href="admin-utilisateurs.php">👥 Utilisateurs</a>
        <a href="logout.php" class="logout">🚪 Déconnexion</a>
      </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="main-content">
      <header>
        <h1>Bienvenue, <?php echo $_SESSION['admin_email']; ?> 👋</h1>
        <p>Voici un aperçu de votre boutique</p>
      </header>

      <section class="cards">
        <div class="card"><h3>Ventes aujourd'hui</h3><p>120 €</p></div>
        <div class="card"><h3>Commandes en attente</h3><p>8</p></div>
        <div class="card"><h3>Produits en stock</h3><p>152</p></div>
      </section>
    </main>
  </div>
</body>
</html>
