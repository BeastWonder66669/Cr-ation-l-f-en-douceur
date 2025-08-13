<?php
require 'check-login.php';
require 'db.php';

// SUPPRIMER
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $db->prepare("DELETE FROM commandes WHERE id = ?")->execute([$id]);
  header("Location: admin-commandes.php"); exit;
}

// AJOUTER (client + total + statut)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['client'], $_POST['total'], $_POST['statut'])) {
  $client = trim($_POST['client']);
  $total  = (float)$_POST['total'];
  $statut = $_POST['statut']; // 'En attente','Payé','Annulé'

  $stmt = $db->prepare("INSERT INTO commandes (client, total, statut) VALUES (?, ?, ?)");
  $stmt->execute([$client, $total, $statut]);
}

// LISTER
$commandes = $db->query("SELECT * FROM commandes ORDER BY date_commande DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
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
      <a class="active" href="admin-commandes.php">🛒 Commandes</a>
      <a href="admin-utilisateurs.php">👥 Utilisateurs</a>
      <a href="logout.php" class="logout">🚪 Déconnexion</a>
    </nav>
  </aside>

  <main class="main-content">
    <header><h1>Gestion des commandes</h1></header>

    <!-- Ajout rapide -->
    <form method="POST" style="margin: 16px 0;">
      <input type="text" name="client" placeholder="Nom du client" required>
      <input type="number" step="0.01" name="total" placeholder="Total (€)" required>
      <select name="statut" required>
        <option>En attente</option>
        <option>Payé</option>
        <option>Annulé</option>
      </select>
      <button type="submit">Ajouter</button>
    </form>

    <section class="table-section">
      <table>
        <thead>
          <tr><th>ID</th><th>Client</th><th>Total</th><th>Statut</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($commandes as $c): ?>
          <tr>
            <td>#<?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['client']) ?></td>
            <td><?= number_format($c['total'], 2, ',', ' ') ?> €</td>
            <td>
              <span class="status <?= $c['statut']==='Payé'?'completed':($c['statut']==='Annulé'?'':'pending') ?>">
                <?= htmlspecialchars($c['statut']) ?>
              </span>
            </td>
            <td><?= htmlspecialchars($c['date_commande']) ?></td>
            <td>
              <a href="admin-commandes-edit.php?id=<?= $c['id'] ?>">✏️ Modifier</a>
              <a href="admin-commandes.php?delete=<?= $c['id'] ?>" onclick="return confirm('Supprimer cette commande ?')">🗑 Supprimer</a>
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
