  <?php
  //session_start();
    // Handle form submission
  // 1. Start session if not already started
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // 2. Include the Shop class
  require_once 'Shop.php';

  // 3. Create a new Shop instance
  $shop = new Shop();

  // 4. Get the current step
  $step = $shop->getStep();

  // 5. Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure $_POST is not empty
    if (!empty($_POST)) {
      $shop->processStep($_POST);
    }

    // If we have completed step 3, store the order and go to confirmation
    if ($shop->getStep() > 4 && isset($_SESSION['reservation_data']['name'])) {
      $shop->storeOrder();
      session_unset();
      session_destroy();
      session_start();
      $_SESSION['step'] = 1;
      header("Location: confirmation.php");
      exit;
    }
  }

  // 6. Restart session if "Restart" button is clicked
  if (isset($_POST['restart'])) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['step'] = 1;
    header("Location: reservation.php");
    exit;
  }

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CouBooks - Reservation</title>
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body>
  <header>
    <h1>COUBOOKS</h1>
    <h2>A WEBTECH DEMO SITE</h2>
    <nav>
      <ul>
        <li><a href="./index.php">HOME</a></li>
        <li><a href="./courses.html">COURSES</a></li>
        <li><a href="./reservation.php">RESERVATION</a></li>
        <li><a href="./about.html">ABOUT</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h2>Reservation Step <?php echo $step; ?></h2>

    <form action="./reservation.php" method="POST">
      <input type="hidden" name="step" value="<?php echo $step; ?>">

      <?php if ($step == 1): ?>
        <section>
          <h3>STEP 1 - WHO ARE YOU?</h3>
          <label for="year">Year:</label>
          <select id="year" name="year" required>
            <option value="">-- Select your year --</option>
            <option value="first">First Bachelor</option>
            <option value="second">Second Bachelor</option>
            <option value="third">Third Bachelor</option>
          </select>

          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required />

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required />

          <button type="submit">Next &gt;&gt;</button>
        </section>

      <?php elseif ($step == 2): ?>
        <section>
          <h3>STEP 2 - WHAT BOOKS DO YOU NEED?</h3>
          <p>Select the books you need to order</p>

          <div>
            <input type="checkbox" id="book1" name="books[]" value="Computer networking: A top down approach">
            <label for="book1">Computer networking: A top down approach</label>
          </div>

          <div>
            <input type="checkbox" id="book2" name="books[]" value="Silberschatz's Operating System Concepts">
            <label for="book2">Silberschatz's Operating System Concepts</label>
          </div>

          <button type="submit">Next &gt;&gt;</button>
        </section>

      <?php elseif ($step == 3): ?>
        <section>
          <h3>STEP 3 - CONFIRM YOUR ORDER</h3>
          <p>Review your details and confirm.</p>

          <button type="submit">Confirm Reservation</button>
        </section>
      <?php endif; ?>
    </form>

    <form method="POST">
      <button type="submit" name="restart">Restart Reservation</button>
    </form>
  </main>

  <footer>
    <p>Copyright © 2025 WebTech. KU Leuven. All Rights Reserved.</p>
  </footer>
  </body>
  </html>
