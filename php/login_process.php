<?php
require_once __DIR__ . "/session.php";       // Gestion des sessions
require_once __DIR__ . "/db.php";            // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        setSessionMessage('error', "Veuillez remplir tous les champs.");
        header("Location: ../index.php");
        exit();
    }

    try {
        $conn = connection_bdd(); // fonction dans db.php qui utilise config.php

        // Requête pour récupérer l'utilisateur
        $stmt = $conn->prepare("SELECT id, role, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            $role = $user['role'];
            $hashedPassword = $user['password'];

            // Vérifier le mot de passe
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $role;

                // Redirection selon le rôle
                switch ($role) {
                    case 'apprenant':
                        header('Location: dashboard_apprenant_process.php');
                        break;
                    case 'admin':
                        header('Location: dashboard_admin_process.php');
                        break;
                    case 'formateur':
                        header('Location: dashboard_formateur_process.php');
                        break;
                    default:
                        setSessionMessage('error', "Rôle non reconnu.");
                        header("Location: ../index.php");
                        exit();
                }
                exit();
            } else {
                setSessionMessage('error', "Mot de passe incorrect.");
                header("Location: ../index.php");
                exit();
            }
        } else {
            setSessionMessage('error', "Utilisateur non trouvé.");
            header("Location: ../index.php");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage(), 3, "../logs/sql_errors.log");
        setSessionMessage('error', "Une erreur est survenue.");
        header("Location: ../index.php");
        exit();
    }
}
?>
