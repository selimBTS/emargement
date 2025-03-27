<?php
session_start();
require_once __DIR__ . '/../config.php';

$_SESSION['user_id'] = 9; // à remplacer par la session réelle
$user_id = $_SESSION['user_id'] ?? null;

$stmt = $pdo->prepare("SELECT firstname, lastname, email, username FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Apprenant</title>
  <link rel="stylesheet" href="styles.css">
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
      justify-content: center;
      padding: 1rem;
    }
    .logo {
      height: 40px;
    }
    .content {
      flex: 1;
      padding: 1.5rem;
      text-align: center;
    }
    .avatar {
      background-color: #E85421;
      color: white;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      margin: 0 auto 1rem;
    }
    h2 {
      margin-bottom: 0.5rem;
    }
    p {
      margin: 0.3rem 0;
      font-size: 0.95rem;
    }
    .btn {
      margin-top: 1rem;
      background-color: #0E1E5B;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
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
      <img src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
    </header>
    <div class="content">
      <div class="avatar">
        <?= strtoupper(substr($user['firstname'], 0, 1)) . strtoupper(substr($user['lastname'], 0, 1)) ?>
      </div>
      <h2><?= htmlspecialchars(strtoupper($user['firstname'] . ' ' . $user['lastname'])) ?></h2>
      <p><b>Nom utilisateur</b><br><?= htmlspecialchars($user['username']) ?></p>
      <p><b>Email</b><br><?= htmlspecialchars($user['email']) ?></p>
      <p><b>Mot de passe</b><br>************</p>
      <a href="modifier_mot_de_passe.php" class="btn">Modifier le mot de passe</a>
    </div>
    <footer>
      <a href="../apprenant/dashboard_apprenant_process.php">🏠<br>Accueil</a>
      <a href="../apprenant/apprenant_calendrier.php">📅<br>Calendrier</a>
      <a href="../apprenant/apprenant_profil.php">👤<br>Profil</a>
    </footer>
  </div>
</body>
</html>