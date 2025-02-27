<?php
require_once 'db.php'; // Include database connection

class Connection {
  public $id;
  public $name;  // Maps to 'author' column
  public $comment; // Maps to 'text' column

  // Fetch all feedback from database
  public static function getAllFeedback() {
    global $db;
    if (!$db) {
      die("Database connection not initialized.");
    }

    $stmt = $db->prepare("SELECT author, text, created FROM feedback ORDER BY created DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Save new feedback to database
  public function save() {
    global $db;
    if (!$db) {
      die("Database connection not initialized.");
    }

    try {
      $stmt = $db->prepare("INSERT INTO feedback (author, text) VALUES (:name, :comment)");
      $stmt->execute([
        ':name' => $this->name,
        ':comment' => $this->comment
      ]);

      echo "✅ Feedback inserted successfully! Name: {$this->name}, Comment: {$this->comment}";
    } catch (PDOException $e) {
      die("❌ Error inserting feedback: " . $e->getMessage());
    }
  }
}
?>
