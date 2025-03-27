<?php
require_once(__DIR__ . '/../config.php');

function connection_bdd() {
    global $pdo;
    return $pdo;
}
