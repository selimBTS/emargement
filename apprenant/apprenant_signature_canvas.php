<?php
session_start();
require_once 'bdd.php';

$_SESSION['user_id'] = 9;
$user_id = $_SESSION['user_id'] ?? null;
$feuille_id = $_GET['id'] ?? null;
$saved = false;
$erreur_signature = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $feuille_id && $user_id) {
    $signature_data = $_POST['signature'] ?? '';

    if ($signature_data && strpos($signature_data, 'base64') !== false) {
        $signature_data = str_replace('data:image/png;base64,', '', $signature_data);
        $signature_data = str_replace(' ', '+', $signature_data);
        $signature_img = base64_decode($signature_data);

        $file_name = 'signatures/signature_' . $user_id . '_' . $feuille_id . '.png';
        if (!is_dir('signatures')) {
            mkdir('signatures', 0777, true);
        }
        file_put_contents($file_name, $signature_img);

        $stmt = $pdo->prepare("UPDATE feuilles_emargements_signatures
            SET signature = 1, heure_signature = NOW()
            WHERE feuille_id = :fid AND user_id = :uid");
        $stmt->execute(['fid' => $feuille_id, 'uid' => $user_id]);

        $saved = true;
    } else {
        $erreur_signature = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signature</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #E85421;
    }
    .popup {
      max-width: 500px;
      margin: 5vh auto;
      background-color: white;
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    h2 {
      margin-bottom: 0.5rem;
    }
    canvas {
      border: 2px solid #ccc;
      width: 100%;
      height: 200px;
      margin: 1rem 0;
    }
    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 1rem;
      border: none;
      margin: 0.5rem;
      cursor: pointer;
    }
    .btn-primary {
      background-color: #0E1E5B;
      color: white;
    }
    .btn-secondary {
      background-color: #ccc;
    }
    .message {
      margin-top: 1rem;
      font-weight: bold;
      opacity: 0;
      animation: fadeIn 1s ease-in forwards;
    }
    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="popup">
    <img id="gefor" src="../image/gefor.jpg" alt="Logo Gefor" class="logo" style="height: 40px; margin-bottom: 1rem;">
    <h2>Emargement</h2>
    <p>Veuillez signer dans le cadre</p>

    <?php if ($saved): ?>
      <p class="message" style="color: green;">✅ Votre signature a été enregistrée.</p>
      <script>
        setTimeout(() => {
          window.location.href = 'apprenant_dashboard.php'; 
      </script>
    <?php elseif ($erreur_signature): ?>
      <p class="message" style="color: red;">❌ Veuillez resigner.</p>
    <?php endif; ?>

    <?php if (!$saved): ?>
      <form method="POST" onsubmit="return saveSignature();">
        <canvas id="signature-pad"></canvas>
        <input type="hidden" name="signature" id="signature-input">
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
        <button type="button" class="btn btn-secondary" onclick="clearCanvas()">Réinitialiser</button>
      </form>
    <?php endif; ?>
  </div>

  <script>
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    let drawing = false;

    canvas.addEventListener('mousedown', e => {
      drawing = true;
      ctx.beginPath();
      ctx.moveTo(e.offsetX, e.offsetY);
    });
    canvas.addEventListener('mousemove', e => {
      if (drawing) {
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
      }
    });
    canvas.addEventListener('mouseup', () => drawing = false);
    canvas.addEventListener('mouseleave', () => drawing = false);

    function clearCanvas() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
      const input = document.getElementById('signature-input');
      input.value = canvas.toDataURL('image/png');
      return true;
    }

    window.addEventListener('load', () => {
      canvas.width = canvas.offsetWidth;
      canvas.height = canvas.offsetHeight;
    });
  </script>
</body>
</html>
