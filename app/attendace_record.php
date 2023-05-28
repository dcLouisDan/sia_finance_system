<?php

session_start();
require_once './util_func.php';
require_once './user_func.php';
require_once './attendance_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $date = $_POST["date"];
  $employee_count = $_POST["employee_count"];
  $attendace = fetchItemOnColumn('tbl_attendance', 'attendance_date', $date, $pdo);

  for ($i = 1; $i <= $employee_count; $i++) {
    $id = $i . "_id";
    $status = $i . "_status";
    $time_in = $i . "_time_in";
    $time_out = $i . "_time_out";
    $employee_id = $_POST["$id"];
    $attendance_status = $_POST["$status"];
    $attendance_time_in = ($_POST["$time_in"]) ? $_POST["$time_in"] : null;
    $attendance_time_out = ($_POST["$time_out"]) ? $_POST["$time_out"] : null;

    if ($attendace != null) {
      $attendance_employee = fetchAttendaceOnEmployeeAndDate($date, $employee_id, $pdo);
      $qry = "UPDATE `tbl_attendance` SET `employee_id`= ?,`attendance_date`= ?,`status_id`= ?,`time_in`= ?,`time_out`= ? WHERE id = ?";


      $params = array($employee_id, $date, $attendance_status, $attendance_time_in, $attendance_time_out, $attendance_employee['id']);
    } else {
      $qry = "INSERT INTO `tbl_attendance`(`employee_id`, `attendance_date`, `status_id`, `time_in`, `time_out`) VALUES (?, ?, ?, ?, ?)";

      $params = array($employee_id, $date, $attendance_status, $attendance_time_in, $attendance_time_out);
    }


    $stmt = $pdo->prepare($qry);
    $stmt->execute($params);
    clearPostInputs([$id, $status]);
  }
  logAction("Employee Attendance for $date successfully recorded.", $pdo);
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Attendace successfully recorded.";
  header("Location: ../$folder/record_attendance.php?date=$date");
  exit;
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/record_attendance.php");
  exit;
}
