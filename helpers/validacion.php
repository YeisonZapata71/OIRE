<?php
function limpiar($str) {
    return htmlspecialchars(strip_tags(trim($str)));
}

function validarGenero($g) {
    return in_array($g, ['masculino', 'femenino', 'unisex']);
}

function validarCategoria($c) {
    return in_array($c, ['tradicional', 'nicho', 'arabe']);
}

function validarPresentacion($ml) {
    return $ml >= 10 && $ml <= 300;
}
