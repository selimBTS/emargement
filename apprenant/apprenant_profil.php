<?php
session_start();
require_once __DIR__ . '/../config.php';

$firstname = htmlspecialchars($_SESSION['firstname'] ?? 'Prénom');
$lastname = htmlspecialchars($_SESSION['lastname'] ?? 'Nom');
$username = htmlspecialchars($_SESSION['username'] ?? 'Nom utilisateur');
$email = htmlspecialchars($_SESSION['email'] ?? 'Email');
$user_initials = strtoupper(substr($_SESSION['firstname'] ?? 'A', 0, 1)) .
                 strtoupper(substr($_SESSION['lastname'] ?? 'Z', 0, 1));
                 
?>

<?php var_dump($_SESSION['email']); ?>

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
    .btn {
      background-color: #0E1E5B;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      display: block;
      margin-top: 1rem;
      text-align: center;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
      <header>
        <div class="avatar"><?= $user_initials ?></div>
        <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
      </header>
      <div class="content">
        <h2><?= strtoupper("$firstname $lastname") ?></h2>
        <p><b>Nom utilisateur</b><br><?= htmlspecialchars($username) ?></p>
        <p><b>Email</b><br><?= htmlspecialchars($email) ?></p>
        <p><b>Mot de passe</b><br>************</p>
        <a href="modifier_mot_de_passe.php" class="btn">Modifier le mot de passe</a>
      </div>

      <footer>
        <a href="http://localhost/myproject/emargement/php/dashboard_apprenant_process.php">🏠<br>Accueil</a>
        <a href="../apprenant/apprenant_calendrier.php">📅<br>Calendrier</a>
        <a href="../apprenant/apprenant_profil.php">👤<br>Profil</a>
        <a href="../php/logout.php">🚪<br>Déconnexion</a>
      </footer>
    </div>

  </div>
</body>
</html>