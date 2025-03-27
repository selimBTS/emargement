<?php
session_start();
require_once 'bdd.php';

// Traitement du formulaire (à compléter avec insertion en base si souhaité)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept'])) {
    // Récupération des données
    $justification = $_POST['justification'] ?? '';
    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';
    $document = $_POST['document'] ?? '';
    $user_id = $_SESSION['user_id'] ?? 0;

    // TODO : Enregistrement en base (table absences_justifiees par exemple)
    $success = true; // simulate success
} 


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Justifier une absence</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #E85421;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background-color: #F1F3F5;
      min-height: 100vh;
      padding-bottom: 2rem;
    }
    header {
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
    }
    .logo {
      height: 40px;
    }
    h2 {
      margin: 2rem 1rem 1rem;
      color: #212529;
      text-align: center;
      font-size: 1.5rem;
    }
    .description {
      font-size: 0.9rem;
      margin: 0 1rem 1rem;
      color: #212529;
      text-align: center;
    }
    form {
      padding: 0 1.5rem;
    }
    input[type="text"],
    input[type="date"] {
      width: 90%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-size: 1rem;
    }
    .checkbox {
      display: flex;
      align-items: flex-start;
      gap: 0.5rem;
      font-size: 0.75rem;
      margin-bottom: 1.5rem;
    }
    .checkbox input {
      margin-top: 0.25rem;
    }
    .submit-btn {
      background-color: #0E1E5B;
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: bold;
      font-size: 0.95rem;
      cursor: pointer;
      display: block;
      margin: 0 auto;
    }
    .success {
      text-align: center;
      background-color: #d4edda;
      color: #155724;
      padding: 1rem;
      margin: 1rem;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo">
    </header>

    <div style="background-color: #dee2e6; padding: 1rem 0; text-align: center;"><h2 style="margin: 0; color: #212529;">Justifier une absence</h2></div>
    <p class="description">
      La demande de justification sera envoyée à un administrateur pour validation
    </p>

    <?php if (!empty($success)) : ?>
      <div class="success">Votre justificatif a bien été envoyé.</div>
    <?php endif; ?>

    <form method="POST">
      <label>Justification</label>
      <input type="text" name="justification" placeholder="Motif de l'absence" required />

      <label>Date de début</label>
      <input type="date" name="date_debut" required />

      <label>Date de fin</label>
      <input type="date" name="date_fin" required />

      <label>Document</label>
      <input type="text" name="document" placeholder="Nom du fichier ou lien (optionnel)" />

      <div class="checkbox">
        <input type="checkbox" name="accept" required />
        <label>
          En validant votre demande de justification d'absence, vous acceptez que vos données puissent être stockées pour la durée maximale légale de conservation. Vos données seront traitées dans le cadre du service proposé par EduSign à l’organisation à laquelle vous appartenez, afin de justifier votre absence en formation.
        </label>
      </div>

      <button type="submit" class="submit-btn">Envoyer un justificatif</button>
    </form>
  </div>
</body>
</html>
