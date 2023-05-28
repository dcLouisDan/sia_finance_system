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


  if (notEmpty($first_name) && notEmpty($middle_name) && notEmpty($last_name) && notEmpty($birthday) && notEmpty($address) && notEmpty($email) && notEmpty($title) && notEmpty($department_id) && notEmpty($salary_hour)) {
    $qry = "INSERT INTO `tbl_employees`(`first_name`, `middle_name`, `last_name`, `birthday`, `address`, `email`, `title`, `department_id`, `salary_hour`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($qry);
    $param = array($first_name, $middle_name, $last_name, $birthday, $address, $email, $title, $department_id, $salary_hour);

    if ($stmt->execute($param)) {
      logAction("New employee: $first_name $last_name added to the system.", $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "New employee successfully added.";
      header("Location: ../$folder/employees.php");
      clearPostInputs(["first_name", "last_name", "middle_name", "birthday", "address", "email", "title", "department_id", "salary_hour"]);
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
