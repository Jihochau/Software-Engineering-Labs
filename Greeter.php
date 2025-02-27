<?php

class Greeter {
  private $greetings = [
    "Welcome to CouBooks!",
    "Hello, ready to study?",
    "Good day! Check out our courses.",
    "Hi there! Reserve your books today."
  ];

  public function __construct() {
    // (Optional) any initialization if needed
  }

  public function getGreeting(): string {
    // Pick a random greeting from the array
    $index = array_rand($this->greetings);
    return $this->greetings[$index];
  }
}
