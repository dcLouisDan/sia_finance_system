<?php
session_start();
require_once './util_func.php';
require_once './user_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];
  $access_lvl = $_POST["access_lvl"];
  $password = $_POST["password"];
  $repeat_password = $_POST["repeat_password"];

  if ($password !== $repeat_password) {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Password did not match.";
    header("Location: ../$folder/manage_users.php");
    exit;
  } else {
    $hashedPassword = password_hash($repeat_password, PASSWORD_DEFAULT);
  }

  if (emailExists($email, $pdo)) {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Email already used by another user.";
    header("Location: ../$folder/manage_users.php");
    exit;
  }

  if (notEmpty($first_name) && notEmpty($last_name) && notEmpty($email) && notEmpty($access_lvl) && notEmpty($hashedPassword)) {
    $qry = "INSERT INTO `tbl_finance_users`(`first_name`, `last_name`, `email`, `password`,`access_lvl`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($qry);
    $param = array($first_name, $last_name, $email, $hashedPassword, $access_lvl);

    if ($stmt->execute($param)) {
      logAction("New user: $first_name $last_name added to the system.", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "New user successfully added.";
      header("Location: ../$folder/manage_users.php");
      clearPostInputs(["first_name", "last_name", "email"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/manage_users.php");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/manage_users.php");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/manage_users.php");
  exit;
}
