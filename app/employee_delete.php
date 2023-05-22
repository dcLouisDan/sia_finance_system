<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $employee_id = $_POST["employee_id"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];



  if (notEmpty($employee_id)) {
    $stmt = $pdo->prepare("DELETE FROM `tbl_employees` WHERE id = ?");

    $params = [$employee_id];

    if ($stmt->execute($params)) {

      logAction("Deleted Employee: $first_name $last_name", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Employee successfuly deleted.";
      header("Location: ../$folder/employees.php");
      clearPostInputs(["first_name", "last_name", "employee_id"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/employees.php");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/employees.php");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/employees.php");
  exit;
}
