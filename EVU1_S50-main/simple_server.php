<?php
// Simple development server for Laravel

// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

// Remove query parameters for simple routing
$cleanPath = explode('?', $path)[0];

// If it's a file in public, serve it
$filePath = __DIR__ . '/public' . $cleanPath;
if ($cleanPath !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false; // Let PHP serve the file
}

// Otherwise, route through Laravel
require_once __DIR__ . '/public/index.php';
