<?php
session_start(); // Start session to store user input

class Shop {
  public function __construct() {
    // Initialize session variables if they don’t exist
    if (!isset($_SESSION['step'])) {
      $_SESSION['step'] = 1;
      $_SESSION['reservation_data'] = []; // Store form data
    }
  }

  // Get the current step
  public function getStep() {
    return $_SESSION['step'];
  }

  // Store form data in session
  public function processStep($data) {
    $_SESSION['reservation_data'] = array_merge($_SESSION['reservation_data'], $data);

    // Move to the next step
    $_SESSION['step']++;
  }

  // Save data in the database at the last step
  public function storeOrder() {
    require_once 'db.php'; // Include database connection
    global $db;

    // Extract data from session
    $data = $_SESSION['reservation_data'];

    // Insert into reservation table
    $stmt = $db->prepare("INSERT INTO reservation (name, email, date, time, type) VALUES (:name, :email, :date, :time, :type)");
    $stmt->execute([
      ':name' => $data['name'],
      ':email' => $data['email'],
      ':date' => $data['date'],
      ':time' => $data['time'],
      ':type' => $data['type']
    ]);

    // Clear session data
    session_destroy();
  }
}
?>
