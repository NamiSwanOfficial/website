<?php
function getProjectRoot($path, $levels = 1) {
    for ($i = 0; $i < $levels; $i++) {
        $path = dirname($path);
    }
    return $path;
}

function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception("Le fichier .env n'existe pas");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

loadEnv(getProjectRoot(dirname(__FILE__)) . '/.env');
?>