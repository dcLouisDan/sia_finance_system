<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $employee_id = $_POST["employee_id"];
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];
  $leave_type = $_POST["leave_type"];
  $status_id = $_POST["status_id"];

  if (notEmpty($employee_id) && notEmpty($start_date) && notEmpty($end_date) && notEmpty($leave_type) && notEmpty($status_id)) {
    $qry = "INSERT INTO `tbl_leave`(`employee_id`, `start_date`, `end_date`, `leave_type`, `status_id`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($qry);
    $param = array($employee_id, $start_date, $end_date, $leave_type, $status_id,);

    if ($stmt->execute($param)) {
      logAction("New leave for Employee No: $employee_id added to the system.", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Employee leave successfully added.";
      header("Location: ../$folder/leave_and_vacation.php");
      clearPostInputs(["employee_id", "start_date", "end_date", "leave_type", "status_id"]);
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
