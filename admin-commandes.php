<?php require 'check-login.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Commandes - Admin</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <div class="admin-container">
    <aside class="sidebar">
      <h2>Mon Admin</h2>
      <nav>
        <a href="admin-dashboard.php">🏠 Tableau de bord</a>
        <a href="admin-produits.php">📦 Produits</a>
        <a href="admin-commandes.php" class="active">🛒 Commandes</a>
        <a href="admin-utilisateurs.php">👥 Utilisateurs</a>
        <a href="logout.php" class="logout">🚪 Déconnexion</a>
      </nav>
    </aside>

    <main class="main-content">
      <header>
        <h1>Gestion des commandes</h1>
      </header>

      <section class="table-section">
        <table>
          <thead>
            <tr><th>ID</th><th>Client</th><th>Total</th><th>Statut</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <tr>
              <td>#1023</td><td>Jean Dupont</td><td>120 €</td>
              <td><span class="status pending">En attente</span></td>
              <td><button>✅ Valider</button> <button>❌ Annuler</button></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
