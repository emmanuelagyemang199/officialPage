<?php
// Admin login with simple session authentication
require __DIR__ . '/../config/config.php';
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    if (!$email) {
        $error = 'Please enter a valid email.';
    } elseif (empty($password)) {
        $error = 'Please enter a password.';
    } else {
        $adminUser = cfg('ADMIN_USER', 'admin@example.com');
        $adminPass = cfg('ADMIN_PASS', 'ChangeMe123');
        if (strtolower($email) === strtolower($adminUser) && $password === $adminPass) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $adminUser;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid credentials.';
        }
    }
}

require __DIR__ . '/../includes/header.php';
?>
<main>
    <h1>Admin Login</h1>
    <?php if ($error): ?>
    <p style="color:red"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <button type="submit">Login</button>
    </form>
</main>
<?php require __DIR__ . '/../includes/footer.php';