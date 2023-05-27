<?php 

function fetchAttendaceOnEmployeeAndDate ($date, $employee_id, $pdo)
{
  $sql = "SELECT * FROM tbl_attendance WHERE attendance_date = ? AND employee_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$date, $employee_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}
