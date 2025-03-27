<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        // Redirection vers la page de connexion si non authentifié
        header("Location: ../index.php");
        exit();
    }
}
