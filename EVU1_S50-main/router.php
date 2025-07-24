<?php
// Router para desarrollo con servidor PHP integrado

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Si el archivo existe, sírvelo directamente
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Sino, redirige al index.php de Laravel
require_once __DIR__.'/public/index.php';
