<?php
require 'check-login.php';
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$id]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$u) { die("Utilisateur introuvable."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $role  = $_POST['role'];

  $upd = $db->prepare("UPDATE utilisateurs SET email=?, role=? WHERE id=?");
  $upd->execute([$email, $role, $id]);

  header("Location: admin-utilisateurs.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier utilisateur #<?= $u['id'] ?></title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body style="padding:20px;background:#f5f6fa;">
  <h1>Modifier utilisateur #<?= $u['id'] ?></h1>
  <form method="POST" class="card" style="max-width:520px;padding:20px;">
    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required>

    <label>Rôle</label>
    <select name="role" required>
      <option <?= $u['role']==='Client'?'selected':'' ?>>Client</option>
      <option <?= $u['role']==='Admin'?'selected':'' ?>>Admin</option>
    </select>

    <button type="submit" style="margin-top:12px;">Enregistrer</button>
    <a href="admin-utilisateurs.php" style="margin-left:8px;">Annuler</a>
  </form>
</body>
</html>
