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
      border-top: 1px solid #ccc;
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

    <h2>Calendrier</h2>

    <div class="calendar-controls">
      <button id="prev-month">◀</button>
      <span id="month-label">Mois</span>
      <button id="next-month">▶</button>
    </div>

    <table class="calendar" id="calendar"></table>

    <footer>
      <a href="../apprenant/apprenant_dashboard.php">🏠<br>Accueil</a>
      <a href="../apprenant/apprenant_calendrier.php">📅<br>Calendrier</a>
      <a href="../apprenant/apprenant_profil.php">👤<br>Profil</a>
    </footer>
  </div>

  <script src="script.js"></script>
  
</body>
</html>