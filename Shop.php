<?php
//session_start(); // Start session to store user input

class Shop {
  public function __construct() {
    // Initialize session variables if they don’t exist
    if (!isset($_SESSION['step'])) {
      $_SESSION['step'] = 1;
      $_SESSION['reservation_data'] = []; // Store form data
    }
    if (!isset($_SESSION['reservation_data']) || !is_array($_SESSION['reservation_data'])) {
      $_SESSION['reservation_data'] = []; // Ensure it's an array
    }

  }

  // Get the current step
  public function getStep() {
    return $_SESSION['step'];
  }

  // Store form data in session
  public function processStep($data) {
    if (!isset($_SESSION['reservation_data'])) {
      $_SESSION['reservation_data'] = [];
    }

    // Ensure each step's data is stored separately
    if (!empty($data)) {
      $_SESSION['reservation_data'] = array_merge($_SESSION['reservation_data'], $data);

      // Only move to the next step if we actually received data
      $_SESSION['step']++;
    }
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
      ':name' => $data['name'] ?? null,
      ':email' => $data['email'] ?? null,
      ':date' => $data['date'] ?? date('Y-m-d'),
      ':time' => $data['time'] ?? date('H:i:s'),
      ':type' => $data['type'] ?? null
    ]);

    // Clear session data
    $_SESSION = [];
    session_destroy();
  }
}
?>
