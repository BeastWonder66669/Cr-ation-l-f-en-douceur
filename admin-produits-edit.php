<?php
require 'check-login.php';
require 'db.php';

$id = intval($_GET['id']);
$produit = $db->prepare("SELECT * FROM produits WHERE id = ?");
$produit->execute([$id]);
$produit = $produit->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    die("Produit introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];

    $stmt = $db->prepare("UPDATE produits SET nom=?, prix=?, stock=?, image=? WHERE id=?");
    $stmt->execute([$nom, $prix, $stock, $image, $id]);

    header("Location: admin-produits.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier produit</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <h1>Modifier produit</h1>
  <form method="POST">
    <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>
    <input type="number" step="0.01" name="prix" value="<?= $produit['prix'] ?>" required>
    <input type="number" name="stock" value="<?= $produit['stock'] ?>" required>
    <input type="text" name="image" value="<?= htmlspecialchars($produit['image']) ?>">
    <button type="submit">Enregistrer</button>
  </form>
</body>
</html>
