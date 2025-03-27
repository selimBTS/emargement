<?php
require_once(__DIR__ . '/session.php');
require_once(__DIR__ . '/db.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/auth.php'); // Ajout pour protéger l'accès

// Vérifier si l'utilisateur est connecté et a le rôle apprenant
requireAuth('apprenant'); // Protection d'accès

// Charger les informations de l'utilisateur
// (Décommenter si la fonction existe dans functions.php)
// loadUserData();

// Vérifier que les valeurs de session existent avant d'affecter les variables
$firstname = htmlspecialchars($_SESSION['firstname'] ?? 'Apprenant');
$lastname = htmlspecialchars($_SESSION['lastname'] ?? '');
$user_photo = !empty($_SESSION['user_photo']) ? $_SESSION['user_photo'] : '';
$user_initials = strtoupper(substr($_SESSION['firstname'] ?? 'A', 0, 1)) .
                 strtoupper(substr($_SESSION['lastname'] ?? 'Z', 0, 1));


// Connexion à la base de données
$pdo = connection_bdd();

// Récupérer les statistiques via des fonctions réutilisables
$apprenants = getTotalUsersByRole($pdo, 'apprenant');
$formateurs = getTotalUsersByRole($pdo, 'formateur');
$emargements = getTotalEmargements($pdo);
$emargementsToday = getFeuillesEmargementsToday($pdo);

// Générer la date actuelle
$current_date = date('d/m/Y');

// Charger le contenu HTML du tableau de bord
require_once(__DIR__ . '/../php/dashboard_apprenant_process.php');
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
  background: white;
  padding: 0.5rem 0;
  display: flex;
  justify-content: space-around;
  align-items: center;
  border-top: 1px solid #ccc;
}

footer a {
  text-decoration: none;
  text-align: center;
  font-size: 0.9rem;
  font-weight: bold;
  color: #212529;
}

footer a:nth-child(1) { color: #E85421; } /* Accueil */
footer a:nth-child(2) { color: #0E1E5B; } /* Calendrier */
footer a:nth-child(3) { color: #6C63FF; } /* Profil */
footer a:nth-child(4) { color: #BF360C; } /* Déconnexion */
  </style>
</head>
<body>
  <div class="container">
    <header>
    <div class="avatar"><?= htmlspecialchars($user_initials) ?></div>
      <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
    </header>
    <div class="content">
    <h2>Bonjour <?= $firstname . ' ' . $lastname ?></h2>

<button class="btn-justifier" onclick="location.href='<?= BASE_URL ?>/apprenant/apprenant_justifier_absence.php'">
  Justifier une absence
</button>

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
  <a href="../php/dashboard_apprenant_process.php">🏠<br>Accueil</a>
  <a href="../apprenant/apprenant_calendrier.php">📅<br>Calendrier</a>
  <a href="../apprenant/apprenant_profil.php">👤<br>Profil</a>
  <a href="../php/logout.php">🚪<br>Déconnexion</a>
</footer>

  </div>
</body>
</html>
