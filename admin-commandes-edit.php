<?php
require 'check-login.php';
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM commandes WHERE id = ?");
$stmt->execute([$id]);
$c = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$c) { die("Commande introuvable."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $client = trim($_POST['client']);
  $total  = (float)$_POST['total'];
  $statut = $_POST['statut'];

  $upd = $db->prepare("UPDATE commandes SET client=?, total=?, statut=? WHERE id=?");
  $upd->execute([$client, $total, $statut, $id]);

  header("Location: admin-commandes.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier commande #<?= $c['id'] ?></title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body style="padding:20px;background:#f5f6fa;">
  <h1>Modifier commande #<?= $c['id'] ?></h1>
  <form method="POST" class="card" style="max-width:520px;padding:20px;">
    <label>Client</label>
    <input type="text" name="client" value="<?= htmlspecialchars($c['client']) ?>" required>

    <label>Total (€)</label>
    <input type="number" step="0.01" name="total" value="<?= htmlspecialchars($c['total']) ?>" required>

    <label>Statut</label>
    <select name="statut" required>
      <option <?= $c['statut']==='En attente'?'selected':'' ?>>En attente</option>
      <option <?= $c['statut']==='Payé'?'selected':'' ?>>Payé</option>
      <option <?= $c['statut']==='Annulé'?'selected':'' ?>>Annulé</option>
    </select>

    <button type="submit" style="margin-top:12px;">Enregistrer</button>
    <a href="admin-commandes.php" style="margin-left:8px;">Annuler</a>
  </form>
</body>
</html>
