<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $payroll_id = $_POST["payroll_id"];



  if (notEmpty($payroll_id)) {
    $stmt = $pdo->prepare("DELETE FROM `tbl_payroll` WHERE id = ?");

    $params = [$payroll_id];

    if ($stmt->execute($params)) {

      logAction("Payroll id: $payroll_id deleted", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Leave successfuly deleted.";
      header("Location: ../$folder/payroll.php");
      clearPostInputs(["payroll_id"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/payroll.php");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/payroll.php");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/payroll.php");
  exit;
}
