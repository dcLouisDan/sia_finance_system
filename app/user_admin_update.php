<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $user_id = $_POST["user_id"];
  $access_lvl = $_POST["access_lvl"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];


  if (notEmpty($first_name) && notEmpty($last_name) && notEmpty($email) && notEmpty($user_id) && notEmpty($access_lvl)) {
    $stmt = $pdo->prepare("UPDATE `tbl_finance_users` SET `first_name`= ?,`last_name`= ?,`email`= ?, `access_lvl` = ? WHERE id = ?");

    $params = [$first_name, $last_name, $email, $access_lvl, $user_id];

    if ($stmt->execute($params)) {

      logAction("Updated user information of User: $first_name $last_name", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "User information successfuly updated.";
      header("Location: ../$folder/manage_users.php?id=$user_id");
      clearPostInputs(["first_name", "last_name", "email", "access_lvl", "user_id"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/manage_users.php?id=$user_id");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/manage_users.php?id=$user_id");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/manage_users.php?id=$user_id");
  exit;
}
