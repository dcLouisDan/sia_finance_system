<?php
include_once './util_func.php';
include_once '../config.php';
include_once './fee_func.php';

$last_sem = fetchlastItem('tbl_semester', $pdo);
$sem_id = (isset($_GET["sem_id"])) ? $_GET["sem_id"] : $last_sem['id'];
$semester = fetchItem('tbl_semester', $sem_id, $pdo);
$student_records = fetchStudentRecordsOnSem($sem_id, $pdo);
$program_fee_reports = fetchFeesReportOnSem($sem_id, $pdo);

if (count($program_fee_reports) != 0) {
  $delimiter = ",";
  $filename = "FinancialReport_" .  getOrdinal($semester['sem_num']) . "Sem_AY" . $semester['start_year'] . "-" . $semester['end_year'] . ".csv";

  // Create a file pointer 
  $f = fopen('php://memory', 'w');


  $row = array('College Fees');
  fputcsv($f, $row, $delimiter);

  $row = array(getOrdinal($semester['sem_num']) . " Semester AY " . $semester['start_year'] . "-" . $semester['end_year']);
  fputcsv($f, $row, $delimiter);

  // Set column headers 
  $fields = array('Program', 'Paid Fees', 'Unpaid Fees', 'Total');
  fputcsv($f, $fields, $delimiter);

  $paid_total = 0;
  $remain_total = 0;
  $total_total = 0;
  foreach ($program_fee_reports as $program) {
    $paid_amount = $program['amount'] - $program['remaining_balance'];
    $paid_total += $paid_amount;
    $remain_total += $program['remaining_balance'];
    $total_total += $program['amount'];
    $lineData = array($program['program_name'], number_format((float)$paid_amount, 2, '.', ''), $program['remaining_balance'], $program['amount']);
    fputcsv($f, $lineData, $delimiter);
  }

  $lineData = array("Total", number_format((float)$paid_total, 2, '.', ''), number_format((float)$remain_total, 2, '.', ''), number_format((float)$total_total, 2, '.', ''));
  fputcsv($f, $lineData, $delimiter);


  // Move back to beginning of file 
  fseek($f, 0);

  // Set headers to download file rather than displayed 
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '";');

  //output all remaining data on a file pointer 
  fpassthru($f);
}
exit;
