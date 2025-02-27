<?php
require_once 'connection.php'; // Include the new class

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newFeedback = new Connection(); // Use the new class name

  // Ensure inputs are trimmed and not empty
  $newFeedback->name = !empty(trim($_POST['name'])) ? trim($_POST['name']) : 'Anonymous';
  $newFeedback->comment = !empty(trim($_POST['comment'])) ? trim($_POST['comment']) : 'No comment';

  // Debugging output
  echo "Debug: Name = {$newFeedback->name}, Comment = {$newFeedback->comment}<br>";

  // Save feedback to database
  $newFeedback->save();

  // Redirect to prevent duplicate submission
  header('Location: feedback.php?success=1');
  exit;
}

// Fetch all feedback from database
$allFeedback = Connection::getAllFeedback();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feedback Page</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header>
  <h1>Feedback</h1>
</header>

<main>
  <h2>Feedback</h2>
  <?php if (isset($_GET['success'])): ?>
    <p style="color: green;">Thank you for your feedback!</p>
  <?php endif; ?>

  <!-- Feedback Form -->
  <form action="feedback.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" required></textarea>

    <button type="submit">Submit Feedback</button>
  </form>

  <hr>

  <!-- Display All Feedback -->
  <h3>All Feedback</h3>
  <?php foreach ($allFeedback as $fb): ?>
    <div style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
      <strong><?php echo htmlspecialchars($fb['author'] ?? 'Anonymous'); ?></strong>
      <br>
      <?php echo nl2br(htmlspecialchars($fb['text'] ?? 'No comment provided')); ?>
      <br><em><?php echo $fb['created'] ?? 'Unknown time'; ?></em>
    </div>
  <?php endforeach; ?>
</main>

<footer>
  <p>© 2025 WebTech. KU Leuven. All Rights Reserved.</p>
</footer>
</body>
</html>
