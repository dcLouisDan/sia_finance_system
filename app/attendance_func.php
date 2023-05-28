<?php

function fetchAttendanceOnEmployeeAndDate($date, $employee_id, $pdo)
{
  $sql = "SELECT * FROM tbl_attendance WHERE attendance_date = ? AND employee_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$date, $employee_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function generateEmployeeBasePayroll($employee_id, $start_date, $end_date, $pdo)
{
  $sql = "SELECT * FROM tbl_attendance WHERE attendance_date BETWEEN ? AND ? AND employee_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$start_date, $end_date, $employee_id]);
  $attendanceArray =  ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;

  $employee = fetchItem('tbl_employees', $employee_id, $pdo);
  $salary_hour = $employee['salary_hour'];
  $pay = 0.00;

  foreach ($attendanceArray as $attendance) {
    if ($attendance['status_id'] == '1') {
      $number_of_hours = calculateHoursPassed($attendance['time_in'], $attendance['time_out']) ?? 0;
      $salary_day = $salary_hour * $number_of_hours;
      $pay += $salary_day;
    }
  }

  return $pay;
}
