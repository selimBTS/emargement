<?php
session_start();
require_once 'bdd.php';

$_SESSION['user_id'] = 9; // à remplacer par la session réelle
$user_id = $_SESSION['user_id'] ?? null;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_password && $new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :pwd WHERE id = :id");
        $stmt->execute(['pwd' => $hashed_password, 'id' => $user_id]);

        header('Location: apprenant_profil.php');
        exit();
    } else {
        $message = "Les mots de passe ne correspondent pas.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier le mot de passe</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #E85421;
    }
    .container {
      max-width: 500px;
      background: #F1F3F5;
      margin: 5vh auto;
      padding: 2rem;
      border-radius: 12px;
      text-align: center;
    }
    h2 {
      margin-bottom: 1rem;
    }
    input {
      width: 100%;
      padding: 0.75rem;
      margin: 0.5rem 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
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
    }
    .message {
      margin-top: 1rem;
      font-weight: bold;
      color: green;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Modifier votre mot de passe</h2>
    <?php if ($message): ?>
      <p class="message <?= strpos($message, 'succès') === false ? 'error' : '' ?>"><?= $message ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
      <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
      <button type="submit" class="btn">Valider</button>
    </form>
  </div>
</body>
</html>