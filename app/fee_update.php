<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $program_id = $_POST["program_id"];
  $tuition_fee = $_POST["tuition_fee"];
  $misc_fee = $_POST["misc_fee"];
  $registration_fee = $_POST["registration_fee"];
  $library_fee = $_POST["library_fee"];
  $laboratory_fee = $_POST["laboratory_fee"];
  $guidance_fee = $_POST["guidance_fee"];
  $computer_fee = $_POST["computer_fee"];
  $athletic_fee = $_POST["athletic_fee"];

  if (notEmpty($program_id) && notEmpty($tuition_fee) && notEmpty($misc_fee) && notEmpty($registration_fee) && notEmpty($library_fee) && notEmpty($laboratory_fee) && notEmpty($guidance_fee) && notEmpty($computer_fee) && notEmpty($athletic_fee)) {
    $stmt = $pdo->prepare("UPDATE `tbl_fee_struc` SET `tuition_fee`= ?,`misc_fee`= ?,`registration_fee`= ?,`library_fee`= ?,`laboratory_fee`= ?,`guidance_fee`= ?,`computer_fee`= ?,`athletic_fee`= ? WHERE program_id = ?");

    $params = [$tuition_fee, $misc_fee, $registration_fee, $library_fee, $laboratory_fee, $guidance_fee, $computer_fee, $athletic_fee, $program_id];

    if ($stmt->execute($params)) {
      $folder = $_SESSION["folder"];
      header("Location: ../$folder/program_fees.php?id=$program_id");
      clearPostInputs(["program_id", "tuition_fee", "misc_fee", "registration_fee", "library_fee", "laboratory_fee", "guidance_fee", "computer_fee", "athletic_fee"]);
      echo "<script>alert('Success')</script>";
      exit;
    } else {
      echo "<script>alert('Something went wrong')</script>";
    }
  } else {
    echo "<script>alert('Something went wrong')</script>";
  }
} else {
  echo "<script>alert('Something went wrong')</script>";
}
