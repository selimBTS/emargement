<?php
session_start();
require_once 'bdd.php';

$_SESSION['user_id'] = 9;
$user_id = $_SESSION['user_id'] ?? null;

$feuille_id = $_GET['id'] ?? null;
$feuille = null;
$formateur = null;

if ($feuille_id && $user_id) {
    $stmt = $pdo->prepare("
        SELECT f.nom AS formation, f.date_debut, f.date_fin, f.formateur_id, u.firstname AS formateur
        FROM feuilles_emargements f
        JOIN users u ON u.id = f.formateur_id
        WHERE f.id = :id
    ");
    $stmt->execute(['id' => $feuille_id]);
    $feuille = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("
            UPDATE feuilles_emargements_signatures
            SET signature = 1, heure_signature = NOW()
            WHERE feuille_id = :fid AND user_id = :uid
        ");
        $stmt->execute(['fid' => $feuille_id, 'uid' => $user_id]);
        $signed = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signature Émargement</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #E85421;
    }
    .container {
      max-width: 400px;
      margin: auto;
      background-color: #F1F3F5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem 1rem;
    }
    header {
      background-color: #fff;
      width: 100%;
      display: flex;
      justify-content: center;
      padding: 1rem;
    }
    .logo {
      height: 40px;
    }
    .info {
      width: 100%;
      margin-top: 1.5rem;
    }
    .info h3 {
      background-color: #dee2e6;
      padding: 0.75rem;
      margin: 0;
    }
    .info p {
      margin: 0.75rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.95rem;
    }
    .btn {
      margin-top: 2rem;
      background-color: #0E1E5B;
      color: #fff;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }
    .signed-message {
      margin-top: 2rem;
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
    </header>

    <?php if ($feuille): ?>
      <div class="info">
        <h3><?= htmlspecialchars($feuille['formation']) ?></h3>
        <p>🕒 <?= (new DateTime($feuille['date_debut']))->format('H:i') ?> - <?= (new DateTime($feuille['date_fin']))->format('H:i') ?></p>
        <p>📅 <?= (new DateTime($feuille['date_debut']))->format('d/m/Y') ?></p>
        <p>👤 Intervenant : <strong><?= htmlspecialchars($feuille['formateur']) ?></strong></p>
      </div>

      <?php if (!empty($signed)): ?>
        <div class="signed-message">✔️ Vous avez bien signé cette feuille d’émargement.</div>
      <?php else: ?>
        <a href="apprenant_signature_canvas.html?id=<?= urlencode($feuille_id) ?>" class="btn">Signer</a>
      <?php endif; ?>
    <?php else: ?>
      <p>Feuille d’émargement introuvable.</p>
    <?php endif; ?>
  </div>
</body>
</html>
