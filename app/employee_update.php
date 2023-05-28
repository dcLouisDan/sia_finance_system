<?php
session_start();
require_once './util_func.php';
require_once './employee_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $first_name = $_POST["first_name"];
  $middle_name = $_POST["middle_name"];
  $last_name = $_POST["last_name"];
  $birthday = $_POST["birthday"];
  $address = $_POST["address"];
  $email = $_POST["email"];
  $title = $_POST["title"];
  $department_id = $_POST["department_id"];
  $salary_hour = $_POST["salary_hour"];
  $employee_id = $_POST["employee_id"];


  if (notEmpty($first_name) && notEmpty($middle_name) && notEmpty($last_name) && notEmpty($birthday) && notEmpty($address) && notEmpty($email) && notEmpty($title) && notEmpty($department_id) && notEmpty($salary_hour) && notEmpty($employee_id)) {
    $qry = "UPDATE `tbl_employees` SET `first_name`= ?,`middle_name`= ?,`last_name`= ?,`birthday`= ?,`address`= ?,`email`= ?,`title`= ?,`department_id`= ?, `salary_hour` = ? WHERE id = ?";
    $stmt = $pdo->prepare($qry);
    $param = array($first_name, $middle_name, $last_name, $birthday, $address, $email, $title, $department_id, $salary_hour, $employee_id);

    if ($stmt->execute($param)) {
      logAction("Employee: $first_name $last_name information successfully updated.", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Employee information successfully added.";
      header("Location: ../$folder/employees.php?id=$employee_id");
      clearPostInputs(["first_name", "last_name", "middle_name", "birthday", "address", "email", "title", "department_id", "employee_id", "salary_hour"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/employees.php?id=$employee_id");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/employees.php?id=$employee_id");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/employees.php?id=$employee_id");
  exit;
}
