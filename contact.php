<?php
// simple contact form handling
$success = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $message = trim($_POST['message'] ?? '');
    if ($name === '') $errors[] = 'Name is required.';
    if (!$email) $errors[] = 'Valid email is required.';
    if ($message === '') $errors[] = 'Message cannot be empty.';
    if (empty($errors)) {
        // TODO: send mail or save to DB
        $success = 'Thank you — your message was received.';
    }
}
require __DIR__ . '/includes/header.php';
?>
<main>
  <h1>Contact</h1>
  <?php if ($success): ?><p style="color:green"><?php echo htmlspecialchars($success); ?></p><?php endif; ?>
  <?php if ($errors): ?><ul style="color:red"><?php foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?></ul><?php endif; ?>
  <form method="post" action="contact.php">
    <label>Name: <input name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"></label>
    <label>Email: <input name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"></label>
    <label>Message: <textarea name="message"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea></label>
    <button type="submit">Send</button>
  </form>
</main>
<?php require __DIR__ . '/includes/footer.php';
