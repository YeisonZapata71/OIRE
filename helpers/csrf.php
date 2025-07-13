<?php
function generarTokenCSRF() {
    if (!isset($_SESSION)) session_start();

    // Generar token si no existe
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function validarTokenCSRF($tokenRecibido) {
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['csrf_token']) || $tokenRecibido !== $_SESSION['csrf_token']) {
        return false;
    }

    return true;
}
?>
