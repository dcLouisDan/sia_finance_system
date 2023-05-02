<?php

$methods = array('Cash', 'Check');

function fetchStudentPaymentHistory($id, $pdo)
{
  $sql = "SELECT * FROM tbl_payments WHERE student_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;
}
