<?php
session_start();
require_once 'bdd.php';

// Exemple temporaire d'utilisateur connecté
$_SESSION['user_id'] = 9; // À remplacer par le vrai ID en production

$user_id = $_SESSION['user_id'] ?? null;
$cours_aujourdhui = [];
$cours_passes = [];

if ($user_id) {
    $stmt = $pdo->prepare("
        SELECT f.nom AS formation, s.nom AS salle, f.date_debut, f.date_fin
        FROM feuilles_emargements f
        JOIN salles s ON f.salle_id = s.id
        JOIN feuilles_emargements_signatures fs ON fs.feuille_id = f.id
        WHERE fs.user_id = :user_id
        ORDER BY f.date_debut DESC
    ");
    $stmt->execute(['user_id' => $user_id]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultats as $cours) {
        $debut = new DateTime($cours['date_debut']);
        $fin = new DateTime($cours['date_fin']);
        $now = new DateTime();

        if ($debut->format('Y-m-d') === $now->format('Y-m-d') && $fin > $now) {
            $cours_aujourdhui[] = $cours;
        } elseif ($fin < $now) {
            $cours_passes[] = $cours;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil Apprenant</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #E85421;
    }
    .container {
      background-color: #F1F3F5;
      max-width: 600px;
      margin: auto;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    header {
      background-color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem;
    }
    .avatar {
      background-color: #E85421;
      color: #fff;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
    .logo {
      height: 40px;
    }
    .content {
      padding: 1rem;
    }
    .btn-justifier {
      background-color: #0E1E5B;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      display: block;
      margin: 0 auto 1rem;
    }
    .section {
      background-color: #ddd;
      padding: 0.75rem;
      font-weight: bold;
    }
    .liste-cours {
      padding: 1rem;
    }
    .cours {
      margin-bottom: 1rem;
    }
    .cours p {
      margin: 0.25rem 0;
    }
    footer {
      background-color: #ffffff;
      border-top: 1px solid #ccc;
      padding: 0.5rem;
      display: flex;
      justify-content: space-around;
    }
    footer a {
      text-decoration: none;
      color: #212529;
      text-align: center;
      font-size: 0.9rem;
    }
    footer a.active {
      color: #E85421;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="avatar">AK</div>
      <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
    </header>
    <div class="content">
      <h2>Bonjour Apprenant</h2>
      <button class="btn-justifier" onclick="location.href='justifier_absence.php'">Justifier une absence</button>

      <div class="section">Emargement</div>
      <div class="liste-cours">
        <?php if (!empty($cours_aujourdhui)) : ?>
          <p><strong>Aujourd’hui - Après-midi (<?= count($cours_aujourdhui) ?>)</strong></p>
          <?php foreach ($cours_aujourdhui as $cours): ?>
            <div class="cours">
              <p>🏫 <?= htmlspecialchars($cours['formation']) ?> - <?= htmlspecialchars($cours['salle']) ?></p>
              <p><?= (new DateTime($cours['date_debut']))->format('H:i') ?> - <?= (new DateTime($cours['date_fin']))->format('H:i') ?></p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($cours_passes)) : ?>
          <p><strong>Passé (<?= count($cours_passes) ?>)</strong></p>
          <?php foreach ($cours_passes as $cours): ?>
            <div class="cours">
              <p>🏫 <?= htmlspecialchars($cours['formation']) ?> - <?= htmlspecialchars($cours['salle']) ?></p>
              <p><?= (new DateTime($cours['date_debut']))->format('H:i') ?> - <?= (new DateTime($cours['date_fin']))->format('H:i') ?></p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <footer>
      <a href="#" class="active">🏠<br>Accueil</a>
      <a href="#">📅<br>Calendrier</a>
      <a href="#">👤<br>Profil</a>
    </footer>
  </div>
</body>
</html>
