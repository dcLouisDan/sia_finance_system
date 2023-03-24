<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $user_id = $_SESSION["user"]["id"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];


  if (notEmpty($first_name) && notEmpty($last_name) && notEmpty($email)) {
    $stmt = $pdo->prepare("UPDATE `tbl_finance_users` SET `first_name`= ?,`last_name`= ?,`email`= ? WHERE id = ?");

    $params = [$first_name, $last_name, $email, $user_id];

    if ($stmt->execute($params)) {
      $_SESSION["user"]["first_name"] = $first_name;
      $_SESSION["user"]["last_name"] = $last_name;
      $_SESSION["user"]["email"] = $email;

      logAction("Updated personal information", $pdo);


      $folder = $_SESSION["folder"];
      header("Location: ../$folder/profile.php");
      clearPostInputs(["first_name", "last_name", "email"]);
      echo "<script>alert('Success')</script>";
      exit;
    } else {
      echo "<script>alert('Something went wrong')</script>";
    }
  } else {
    echo "<script>alert('Something went wrong')</script>";
  }
} else {
  echo "<script>alert('Something went wrong')</script>";
}
