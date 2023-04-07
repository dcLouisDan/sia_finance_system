<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $user_id = $_SESSION["user"]["id"];
  $old_password = $_POST["old_password"];
  $new_password = $_POST["new_password"];
  $repeat_new_password = $_POST["repeat_new_password"];
  $folder = $_SESSION["folder"];


  if (notEmpty($old_password) && notEmpty($new_password) && notEmpty($repeat_new_password)) {

    if (password_verify($old_password, $_SESSION['user']['password']) != 1) {
      $_SESSION["alert"] = "Current Password Input is incorrect.";
      header("Location: ../$folder/profile.php");
      exit;
    } else {
      if ($new_password !== $repeat_new_password) {
        $folder = $_SESSION["folder"];
        $_SESSION["alert"] = "Repeat New Password did not match.";
        header("Location: ../$folder/profile.php");
        exit;
      } else {
        $hashedPassword = password_hash($repeat_new_password, PASSWORD_DEFAULT);
      }

      $stmt = $pdo->prepare("UPDATE `tbl_finance_users` SET `password`= ? WHERE id = ?");

      $params = [$hashedPassword, $user_id];

      if ($stmt->execute($params)) {
        $_SESSION["user"]["password"] = $hashedPassword;

        logAction("Updated personal account password", $pdo);


        $_SESSION["alert"] = "User password successfuly updated.";
        header("Location: ../$folder/profile.php");
        clearPostInputs(["old_password", "new_password", "repeat_new_password"]);
        exit;
      } else {
        $folder = $_SESSION["folder"];
        $_SESSION["alert"] = "Something went wrong.";
        header("Location: ../$folder/profile.php");
        exit;
      }
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/profile.php");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/profile.php");
  exit;
}
