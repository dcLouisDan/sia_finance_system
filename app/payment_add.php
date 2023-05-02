<?php
session_start();
require_once './util_func.php';
require_once './fee_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $fee_id = $_POST["fee_id"];
  $student_id = $_POST["student_id"];
  $payment_method = $_POST["payment_method"];
  $amount_paid = $_POST["amount_paid"];
  $balance = $_POST["balance"];

  $param = array($student_id, $fee_id, $amount_paid, $payment_method);

  if (notEmpty($fee_id) && notEmpty($student_id) && notEmpty($payment_method) && notEmpty($amount_paid)) {
    if ($balance == 0) {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "This fee is already paid.";
      header("Location: ../$folder/process_payment.php?id=$student_id");
      exit;
    }

    if ($amount_paid < 0) {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Amount paid cannot have a negative value";
      header("Location: ../$folder/process_payment.php?id=$student_id");
      exit;
    }

    $qry = "INSERT INTO `tbl_payments`(`student_id`, `fee_id`, `amount_paid`, `payment_method`) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($qry);


    if ($stmt->execute($param)) {
      logAction("Php $amount_paid was paid for Fee No. $fee_id by Student NO. $student_id", $pdo);
      generateStudentCollegeBill($student_id, 1, $pdo);


      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Payment successfully recorded.";
      header("Location: ../$folder/student.php?id=$student_id");
      clearPostInputs(["first_name", "last_name", "email"]);
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/process_payment.php?id=$student_id");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input";
    header("Location: ../$folder/process_payment.php?id=$student_id");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/process_payment.php?id=$student_id");
  exit;
}
