<?php
function fetchFeesOnProgram($program_id, $pdo)
{
  $sql = "SELECT * FROM tbl_fee_struc WHERE program_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$program_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function fetchFeeOnStudentCourse($program_id, $pdo)
{
  $sql = "SELECT * FROM tbl_fees WHERE student_course_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$program_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function fetchStudentCourseOnSem($student_id, $sem_id, $pdo)
{
  $sql = "SELECT * FROM tbl_student_course WHERE student_id = ? AND sem_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$student_id, $sem_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function fetchAllPaymentsOnFee($fee_id, $pdo)
{
  $sql = "SELECT * FROM tbl_payments WHERE fee_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$fee_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;
}

function generateStudentCollegeBill($student_id, $sem_id, $pdo)
{
  $studentCourse = fetchStudentCourseOnSem($student_id, $sem_id, $pdo);
  $programFees = fetchFeesOnProgram($studentCourse["program_id"], $pdo);
  $totalFee = ($studentCourse['units'] * $programFees["tuition_fee"]) + $programFees["misc_fee"] + $programFees["registration_fee"] + $programFees["library_fee"] + $programFees["laboratory_fee"] + $programFees["guidance_fee"] + $programFees["computer_fee"] + $programFees["athletic_fee"];

  $studentFee = fetchFeeOnStudentCourse($studentCourse["id"], $pdo);

  if ($studentFee) {
    if ($payments = fetchAllPaymentsOnFee($studentFee['id'], $pdo)) {
      $balance = $totalFee;
      foreach ($payments as $payment) {
        $balance -= $payment['amount_paid'];
      }
      $sql = "UPDATE tbl_fees SET amount = ?, remaining_balance = ? WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$totalFee, $balance, $studentFee['id']]);
      $studentFee = fetchFeeOnStudentCourse($studentCourse["id"], $pdo);
    } else {
      $sql = "UPDATE tbl_fees SET amount = ?, remaining_balance = ? WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$totalFee, $totalFee, $studentFee['id']]);
      $studentFee = fetchFeeOnStudentCourse($studentCourse["id"], $pdo);
    }
  } else {
    $sql = "INSERT INTO `tbl_fees`(`student_course_id`, `amount`, `remaining_balance`) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$studentCourse['id'], $totalFee, $totalFee]);
    $studentFee = fetchFeeOnStudentCourse($studentCourse["id"], $pdo);
  }
}
