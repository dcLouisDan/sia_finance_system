<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $user_id = $_POST["user_id"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];



  if (notEmpty($user_id)) {
    $stmt = $pdo->prepare("DELETE FROM `tbl_finance_users` WHERE id = ?");

    $params = [$user_id];

    if ($stmt->execute($params)) {

      logAction("Deleted User: $first_name $last_name", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "User successfuly deleted.";
      header("Location: ../$folder/manage_users.php");
      clearPostInputs(["first_name", "last_name", "user_id"]);
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
