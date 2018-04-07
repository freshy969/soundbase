<?php
  session_start();
  require_once "../conf.inc.php";
  require_once "../functions.php";

  if (count($_POST) === 2 && !empty($_POST["email"] && !empty($_POST["pwd"]))) {

    $_POST["email"] = strtolower($_POST["email"]);

    // Connection to database
    $connection = connectDB();

    // Query that get the password that matching with the email given
    $query = $connection->prepare("SELECT * FROM MEMBER WHERE email=:toto");

    // Execute the query
    $query->execute([
      "toto" => $_POST["email"]
    ]);

    // Fetch data with the query
    $data = $query->fetch();

    if (password_verify($_POST["pwd"], $data["password"])) {
      $_SESSION["auth"] = true;
      $_SESSION["id"] = $data["id"];
      header("Location: ../home.php");
    } else {
      echo "NOK";
    }

  }
?>
