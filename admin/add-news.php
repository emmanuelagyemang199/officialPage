<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../includes/header.php';

$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title === '') $errors[] = 'Title is required.';
    if ($content === '') $errors[] = 'Content is required.';
    if (empty($errors)) {
        // TODO: insert into DB. For now show success message.
        $success = 'News published (not saved in DB in this stub).';
    }
}
?>
<main>
  <h1>Add News</h1>
  <?php if ($success): ?>
    <p style="color:green"><?php echo htmlspecialchars($success); ?></p>
  <?php endif; ?>
  <?php if ($errors): ?>
    <ul style="color:red">
      <?php foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?>
    </ul>
  <?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <label>Title: <input name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>"></label>
    <label>Content: <textarea name="content"><?php echo isset($content) ? htmlspecialchars($content) : ''; ?></textarea></label>
    <button type="submit">Publish</button>
  </form>
</main>
<?php require __DIR__ . '/../includes/footer.php';
