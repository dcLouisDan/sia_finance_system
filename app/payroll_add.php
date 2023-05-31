<?php
session_start();
require_once './util_func.php';
require_once './attendance_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];

  if (notEmpty($start_date) && notEmpty($end_date)) {
    $qry = "INSERT INTO `tbl_payroll`(`start_date`, `end_date`) VALUES (?, ?)";
    $stmt = $pdo->prepare($qry);
    $param = array($start_date, $end_date);

    if ($stmt->execute($param)) {
      $payroll = fetchlastItem('tbl_payroll', $pdo);
      $payroll_id = $payroll['id'];

      $employeeList = fetchAll('tbl_employees', $pdo);

      foreach ($employeeList as $employee) {
        $pay = generateEmployeeBasePayroll($employee['id'], $start_date, $end_date, $pdo);
        addEmployeePayrollRecord($payroll_id, $employee['id'], $pay, $pdo);
      }

      logAction("New payroll added to the system.", $pdo);
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "New payroll successfully added.";
      header("Location: ../$folder/payroll.php");
      clearPostInputs(["start_date", "end_date"]);
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
