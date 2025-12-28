<?php
// Simple .env loader and config helper
function load_dotenv($path)
{
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (!strpos($line, '=')) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (strlen($name) === 0) continue;
        // remove surrounding quotes
        $value = trim($value, "\"'");
        putenv("$name=$value");
        $_ENV[$name] = $value;
        if (!defined($name)) define($name, $value);
    }
}

$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    load_dotenv($envPath);
} else {
    // fall back to environment or .env.example values when present
    $example = __DIR__ . '/../.env.example';
    if (file_exists($example)) load_dotenv($example);
}

// Provide helper getters
function cfg($key, $default = null) {
    $v = getenv($key);
    if ($v === false) return $default;
    return $v;
}
