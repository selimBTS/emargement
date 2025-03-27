<?php
session_start();
session_unset();     // Supprime toutes les variables de session
session_destroy();   // Détruit la session côté serveur

// Rediriger vers la page de connexion
header("Location: ../index.php");
exit();
