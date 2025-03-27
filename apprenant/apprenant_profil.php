<?php
session_start();
require_once('../config.php');
// $pdo est déjà prêt à l’emploi


$firstname = htmlspecialchars($_SESSION['firstname'] ?? 'Prénom');
$lastname = htmlspecialchars($_SESSION['lastname'] ?? 'Nom');
$username = htmlspecialchars($_SESSION['username'] ?? 'Nom utilisateur');
$email = htmlspecialchars($_SESSION['email'] ?? 'Non défini');
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
      min-height: 50vh;
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
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content:;
      flex: 1;
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
  
footer {
  background: white;
  padding: 0.5rem 0;
  display: flex;
  justify-content: space-around;
  align-items: center;
  border-top: 1px solid #ccc;
  margin-bottom: 3%;
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
  <a href="../php/dashboard_apprenant_process.php" style="color: #E85421; text-align: center;">
    🏠<br>Accueil
  </a>
  <a href="../apprenant/apprenant_calendrier.php" style="color: #0E1E5B; text-align: center;">
    📅<br>Calendrier
  </a>
  <a href="../apprenant/apprenant_profil.php" style="color: #6C63FF; text-align: center;">
    👤<br>Profil
  </a>
  <a href="../php/logout.php" style="color: #BF360C; text-align: center;">
    🚪<br>Déconnexion
  </a>
</footer>

    </div>

  </div>
</body>
</html>