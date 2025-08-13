<?php
require 'check-login.php';
require 'db.php';

// SUPPRIMER
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $db->prepare("DELETE FROM utilisateurs WHERE id = ?")->execute([$id]);
  header("Location: admin-utilisateurs.php"); exit;
}

// AJOUTER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['role'])) {
  $email = trim($_POST['email']);
  $role  = $_POST['role']; // 'Client' ou 'Admin'
  $stmt = $db->prepare("INSERT INTO utilisateurs (email, role) VALUES (?, ?)");
  $stmt->execute([$email, $role]);
}

// LISTER
$utilisateurs = $db->query("SELECT * FROM utilisateurs ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Utilisateurs - Admin</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="admin-container">
  <aside class="sidebar">
    <h2>Mon Admin</h2>
    <nav>
      <a href="admin-dashboard.php">🏠 Tableau de bord</a>
      <a href="admin-produits.php">📦 Produits</a>
      <a href="admin-commandes.php">🛒 Commandes</a>
      <a class="active" href="admin-utilisateurs.php">👥 Utilisateurs</a>
      <a href="logout.php" class="logout">🚪 Déconnexion</a>
    </nav>
  </aside>

  <main class="main-content">
    <header><h1>Gestion des utilisateurs</h1></header>

    <!-- Ajout rapide -->
    <form method="POST" style="margin: 16px 0;">
      <input type="email" name="email" placeholder="email@exemple.com" required>
      <select name="role" required>
        <option>Client</option>
        <option>Admin</option>
      </select>
      <button type="submit">Ajouter</button>
    </form>

    <section class="table-section">
      <table>
        <thead>
          <tr><th>ID</th><th>Email</th><th>Rôle</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($utilisateurs as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['role']) ?></td>
            <td>
              <a href="admin-utilisateurs-edit.php?id=<?= $u['id'] ?>">✏️ Modifier</a>
              <a href="admin-utilisateurs.php?delete=<?= $u['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">🗑 Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </main>
</div>
</body>
</html>

</body>
</html>
