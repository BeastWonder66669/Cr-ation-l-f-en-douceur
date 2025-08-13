<?php require 'check-login.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Produits - Admin</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <div class="admin-container">
    <aside class="sidebar">
      <h2>Mon Admin</h2>
      <nav>
        <a href="admin-dashboard.php">🏠 Tableau de bord</a>
        <a href="admin-produits.php" class="active">📦 Produits</a>
        <a href="admin-commandes.php">🛒 Commandes</a>
        <a href="admin-utilisateurs.php">👥 Utilisateurs</a>
        <a href="logout.php" class="logout">🚪 Déconnexion</a>
      </nav>
    </aside>

    <main class="main-content">
      <header>
        <h1>Gestion des produits</h1>
        <button>➕ Ajouter un produit</button>
      </header>

      <section class="table-section">
        <table>
          <thead>
            <tr><th>ID</th><th>Nom</th><th>Prix</th><th>Stock</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td><td>Chaussures</td><td>59 €</td><td>20</td>
              <td><button>✏️ Modifier</button> <button>🗑 Supprimer</button></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
