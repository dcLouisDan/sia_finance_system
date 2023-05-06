<?php

$methods = array('Cash', 'Check');

function fetchStudentPaymentHistory($id, $pdo)
{
  $sql = "SELECT * FROM tbl_payments WHERE student_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;
}

function fetchStudentPaymentHistoryOnFee($id, $fee_id, $pdo)
{
  $sql = "SELECT * FROM tbl_payments WHERE student_id = ? and fee_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id, $fee_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;
}
