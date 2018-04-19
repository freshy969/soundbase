<?php

require_once "conf.inc.php";

// Connection to database
function connectDB(){

  $dsn = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;

  try {
    $connection = new PDO($dsn, DBUSER, DBPWD);
  } catch (Exception $e) {
    die("SQL error:" . $e->getMessage());
  }

  return $connection;
}

// Check if a user is connected
function isConnected() {

  if (isset($_SESSION["auth"])) {
    return true;
  }

  return false;
}

// Generate a token
function createToken() {
  // random_bytes() returns a cryptographic secure pseudo-random bytes (string)
  // bin2hex() returns a converted binary data in hexadecimal representation
  return bin2hex(random_bytes(32));
}

// Fill signup form fields when submission failed
function fillSessionField($field) {
  return isset($_SESSION["postForm"]) ? $_SESSION["postForm"][$field] : "";
}

// Display error messages in signup form (below fields)
function isErrorPresent($errorNumber) {
  if (isset($_SESSION["errorForm"])) {
    for ($i = 0; $i < count($_SESSION["errorForm"]); $i++) {
      foreach ($_SESSION["errorForm"] as $key) {
        if ($errorNumber === $key) {
          return true;
        }
      }
    }
  }

  return false;
}

// Display login error message when submission failed
function loginErrorMessage() {
  if (isset($_SESSION["message"])) {
    echo '<div class="alert alert-warning" role="alert">' . $_SESSION["message"] . '</div>';
    unset($_SESSION["message"]);
  }
}
