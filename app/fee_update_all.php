<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $tuition_fee = $_POST["tuition_fee"];
  $misc_fee = $_POST["misc_fee"];
  $registration_fee = $_POST["registration_fee"];
  $library_fee = $_POST["library_fee"];
  $laboratory_fee = $_POST["laboratory_fee"];
  $guidance_fee = $_POST["guidance_fee"];
  $computer_fee = $_POST["computer_fee"];
  $athletic_fee = $_POST["athletic_fee"];

  if (notEmpty($tuition_fee) && notEmpty($misc_fee) && notEmpty($registration_fee) && notEmpty($library_fee) && notEmpty($laboratory_fee) && notEmpty($guidance_fee) && notEmpty($computer_fee) && notEmpty($athletic_fee)) {
    $stmt = $pdo->prepare("UPDATE `tbl_fee_struc` SET `tuition_fee`= ?,`misc_fee`= ?,`registration_fee`= ?,`library_fee`= ?,`laboratory_fee`= ?,`guidance_fee`= ?,`computer_fee`= ?,`athletic_fee`= ?");

    $params = [$tuition_fee, $misc_fee, $registration_fee, $library_fee, $laboratory_fee, $guidance_fee, $computer_fee, $athletic_fee];

    if ($stmt->execute($params)) {
      logAction("Updated fee structure of all College Programs", $pdo);

      $folder = $_SESSION["folder"];
      header("Location: ../$folder/program_fees.php");
      clearPostInputs(["tuition_fee", "misc_fee", "registration_fee", "library_fee", "laboratory_fee", "guidance_fee", "computer_fee", "athletic_fee"]);
      $_SESSION["alert"] = "Fee Structure for all programs successfuly updated.";
      exit;
    } else {
      $folder = $_SESSION["folder"];
      $_SESSION["alert"] = "Something went wrong.";
      header("Location: ../$folder/program_fees.php");
      exit;
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Incomplete input.";
    header("Location: ../$folder/program_fees.php");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/program_fees.php");
  exit;
}
