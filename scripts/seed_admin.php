<?php
// Run from CLI: php scripts/seed_admin.php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

$email = cfg('ADMIN_USER', 'admin@example.com');
$pass = cfg('ADMIN_PASS', 'ChangeMe123');

if (php_sapi_name() !== 'cli') {
    echo "This script is intended for CLI use only.\n";
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT id FROM admins WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $row = $stmt->fetch();
    if ($row) {
        echo "Admin already exists (id={$row['id']}).\n";
        exit;
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $ins = $pdo->prepare('INSERT INTO admins (email, password_hash) VALUES (:email, :hash)');
    $ins->execute([':email' => $email, ':hash' => $hash]);
    echo "Admin user created: {$email}\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
