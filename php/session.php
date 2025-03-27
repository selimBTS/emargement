<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fonction pour stocker un message dans la session
function setSessionMessage($type, $message) {
    $_SESSION['flash'][$type] = $message;
}

// Fonction pour récupérer un message et le supprimer
function getSessionMessage($type) {
    if (!empty($_SESSION['flash'][$type])) {
        $msg = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $msg;
    }
    return null;
}
?>
