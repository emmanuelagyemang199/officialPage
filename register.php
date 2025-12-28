<?php
$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    if ($name === '') $errors[] = 'Name is required.';
    if (!$email) $errors[] = 'Valid email is required.';
    if (empty($errors)) {
        // TODO: save to DB or mailing list
        $success = 'Registration successful. Thank you!';
    }
}
require __DIR__ . '/includes/header.php';
?>
<main>
  <h1>Register</h1>
  <?php if ($success): ?><p style="color:green"><?php echo htmlspecialchars($success); ?></p><?php endif; ?>
  <?php if ($errors): ?><ul style="color:red"><?php foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?></ul><?php endif; ?>
  <form method="post" action="register.php">
    <label>Name: <input name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"></label>
    <label>Email: <input name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"></label>
    <button type="submit">Register</button>
  </form>
</main>
<?php require __DIR__ . '/includes/footer.php';
