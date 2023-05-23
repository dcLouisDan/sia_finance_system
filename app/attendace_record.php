<?php

session_start();
require_once './util_func.php';
require_once './user_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $date = $_POST["date"];
  $employee_count = $_POST["employee_count"];
  for ($i = 1; $i <= $employee_count; $i++) {
    $id = $i . "_id";
    $status = $i . "_status";
    $employee_id = $_POST["$id"];
    $attendance_status = $_POST["$status"];

    $qry = "INSERT INTO `tbl_attendance`(`employee_id`, `attendance_date`, `status_id`) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($qry);
    $stmt->execute([$employee_id, $date, $attendance_status]);
    clearPostInputs([$id, $status]);
  }
  logAction("Employee Attendance for $date successfully recorded.", $pdo);
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Attendace successfully recorded.";
  header("Location: ../$folder/record_attendance.php");
  exit;
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/record_attendance.php");
  exit;
}
