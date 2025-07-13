<?php
function tienePermiso($modulo, $accion) {
    if (!isset($_SESSION['permisos']) || !is_array($_SESSION['permisos'])) {
        return false;
    }

    return isset($_SESSION['permisos'][$modulo][$accion]) && $_SESSION['permisos'][$modulo][$accion];
}
