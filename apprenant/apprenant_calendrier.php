<?php
session_start();
require_once('../config.php');

// Variables de session
$user_id = $_SESSION['user_id'] ?? null;
$user_initials = strtoupper(substr($_SESSION['firstname'] ?? 'A', 0, 1)) .
                 strtoupper(substr($_SESSION['lastname'] ?? 'Z', 0, 1));

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


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calendrier - Emargement</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #E85421;
    }
    .container {
      background: #F1F3F5;
      max-width: 600px;
      margin: auto;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    header {
      background: white;
      padding: 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .avatar {
      background: #E85421;
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
    .logo {
      height: 40px;
    }
    h2 {
      margin: 1rem;
      color: #212529;
    }
    .calendar-controls {
      text-align: center;
      margin-bottom: 0.5rem;
    }
    .calendar-controls button {
      margin: 0 0.25rem;
      background: #0E1E5B;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      cursor: pointer;
    }
    .calendar-controls .active {
      background: #E85421;
    }
    table.calendar {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    table.calendar th, table.calendar td {
      text-align: center;
      padding: 1rem;
      border: 1px solid #ddd;
      width: 14.28%;
    }
    table.calendar td.inactive {
      color: #ccc;
    }
    table.calendar td.today {
      background-color: #E85421;
      color: white;
      font-weight: bold;
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
    <div class="avatar"><?= htmlspecialchars($user_initials ?? '') ?></div>
      <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
    </header>

    <h2>Calendrier</h2>

    <div class="calendar-controls">
      <button id="prev-month">◀</button>
      <span id="month-label">Mois</span>
      <button id="next-month">▶</button>
    </div>

    <table class="calendar" id="calendar"></table>

    <footer>
      <a href="http://localhost/myproject/emargement/php/dashboard_apprenant_process.php">🏠<br>Accueil</a>
      <a href="../apprenant/apprenant_calendrier.php">📅<br>Calendrier</a>
      <a href="../apprenant/apprenant_profil.php">👤<br>Profil</a>
      <a href="../php/logout.php">🚪<br>Déconnexion</a>
    </footer>
  </div>

  <script src="script.js"></script>
  
</body>
</html>