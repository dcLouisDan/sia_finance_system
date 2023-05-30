<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $leave_id = $_POST["leave_id"];



  if (notEmpty($leave_id)) {
    $stmt = $pdo->prepare("DELETE FROM `tbl_leave` WHERE id = ?");

    $params = [$leave_id];

    if ($stmt->execute($params)) {

      logAction("Leave id: $leave_id deleted", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Leave successfuly deleted.";
      header("Location: ../$folder/leave_and_vacation.php");
      clearPostInputs(["leave_id"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/leave_and_vacation.php");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/leave_and_vacation.php");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/leave_and_vacation.php");
  exit;
}
