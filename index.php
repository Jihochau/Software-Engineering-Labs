<?php
require_once 'Greeter.php';
$greeter = new Greeter();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CouBooks - Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <h1>COUBOOKS</h1>
  <nav>
    <ul>
      <li><a href="./index.php">HOME</a></li>
      <li><a href="courses.html">COURSES</a></li>
      <li><a href="reservation.php">RESERVATION</a></li>
      <li><a href="about.html">ABOUT</a></li>
    </ul>
  </nav>
</header>

<main>
  <!-- White content box (centered) -->
  <section class="content-box">
    <!-- Dynamic greeting from the Greeter class -->
    <h2><?php echo $greeter->getGreeting(); ?></h2>
    <p>Find all required course materials for your EA program.</p>
    <p>
      This Course Book Service is especially designed as a demonstration
      for the web technology course. The content and books used here
      are purely for demonstration only. Some are used under creative
      license. Feel free to browse through our courses and reserve
      the books you need!
    </p>

    <!-- Right-side "sidebar" area (opening hours & feedback) -->
    <div class="sidebar-right">
      <h3>OPENING HOURS:</h3>
      <p>Mon: 9am-11am<br>Tue: 1pm-4pm<br>Fri: 1pm-4pm</p>

      <h3>FEEDBACK</h3>
      <p>This concept is awesome! <em>(Jeroen)</em></p>
      <p>Is there a mobile app for this site? <em>(Patrick)</em></p>
      <a href="feedback.php">Add feedback...</a>
    </div>
  </section>
</main>

<footer>
  <p>
    Copyright © 2025
    WebTech. KU Leuven. All Rights Reserved.
    <a href="feedback.php">Privacy Policy</a> |
    <a href="#">Terms of Use</a>
  </p>
</footer>
</body>
</html>
