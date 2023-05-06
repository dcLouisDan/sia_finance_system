<?php
require_once '../app/fee_func.php';
require_once '../app/util_func.php';
require_once '../app/payment_func.php';
require_once '../config.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

$last_sem = fetchlastItem('tbl_semester', $pdo);
$sem_id = (isset($_GET["sem_id"])) ? $_GET["sem_id"] : $last_sem['id'];

$student = fetchItem('student_course_view', $_GET["id"], $pdo);
$student_course = fetchStudentCourseOnSem($student['id'], $sem_id, $pdo);
$programFees = fetchFeesOnProgram($student_course['program_id'], $pdo);
$fee = fetchFeeOnStudentCourse($student_course['id'], $pdo);
$sem = fetchItem('tbl_semester', $sem_id, $pdo);


$payments = fetchStudentPaymentHistory($student['id'], $pdo);

$html = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>

  <style>
    * {
      font-size: 12px;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      padding: 2rem 1rem;
    }

    h1 {
      font-size: 16px;
    }

    h2 {
      font-size: 12px;
    }

    .header {
      position: relative;
      text-align: center;
      line-height: 0.5;
    }

    .header h1,
    h2 {
      font-weight: 500;
    }

    .header img{
      position: absolute;
      top: -5px;
      left: 1rem;
      height: 60px;
      width: 60px;
    }

    table {
      border: 2px solid black;
      width: 100%;
      padding: 0;
      border-collapse: collapse;
      table-layout: fixed;
    }

    table tr th,
    table tr td {
      padding: 5px;
    }

    .tb-bordered tr th,
    .tb-bordered tr td {
      border-bottom: 1px solid black;
      padding: 5px;
    }

    .brd-top {
      border-top: 1px solid black;
    }
  </style>
</head>

<body>
  <div class="header">
    <img src="../icon.png">
    <h2>Republic of the Philippines</h2>
    <h1>Don Honorio Ventura State University</h1>
    <h2>Bacolor, Pampanga</h2>
  </div>
  <br>
  <table class="tb-bordered">
    <tr>
      <th colspan="2">Statement of Account</th>
    </tr>
    <tr>
  <td>
    Student Name: <strong>' . $student['last_name'] . ", " . $student['first_name'] . " " . $student['middle_name'] . ' </strong>
  </td>
  <td>
    Registration #: <strong>' . $student_course['id'] . ' </strong>
  </td>
</tr>
<tr>
  <td>
    Student No: <strong>' . $student['id'] . ' </strong>
  </td>
  <td>
    Academic Year & Term: <strong>' . getOrdinal($sem['sem_num']) . " AY " . $sem['start_year'] . "-" . $sem['end_year'] . '</strong>
  </td>
</tr>
<tr>
  <td>
    Program: <strong>' . $student['program_name'] . ' </strong>
  </td>
  <td>
    Date: <strong>' . date("F d, Y") . ' </strong>
  </td>
</tr>
</table>
<table>
<tr>
<td>Tuition Fee (' . $student_course['units'] . ' units)</td>
      <td>Php ' . number_format((float)$programFees['tuition_fee'] * $student['units'], 2, '.', '') . '</td>
    </tr>
    <tr>
      <td>Miscellaneous Fee</td>
      <td>Php ' . $programFees['misc_fee'] . '</td>
    </tr>
    <tr>
      <td>Registration Fee</td>
      <td>Php ' . $programFees['registration_fee'] . '</td>
    </tr>
    <tr>
      <td>Library Fee</td>
      <td>Php ' . $programFees['library_fee'] . '</td>
    </tr>
    <tr>
      <td>Laboratory Fee</td>
      <td>Php ' . $programFees['laboratory_fee'] . '</td>
    </tr>
    <tr>
      <td>Guidance Fee</td>
      <td>Php ' . $programFees['guidance_fee'] . '</td>
    </tr>
    <tr>
      <td>Computer Fee</td>
      <td>Php ' . $programFees['computer_fee'] . '</td>
    </tr>
    <tr>
      <td>Athletic Fee</td>
      <td>Php ' . $programFees['athletic_fee'] . '</td>
    </tr>
    <tr class="brd-top">
      <td style="font-weight: 700;">Total</td>
      <td style="font-weight: 700;">Php ' . $fee['amount'] . '</td>
    </tr>
    <tr>
      <td style="font-weight: 700;">Remaining Balance</td>
      <td style="font-weight: 700;">Php ' . $fee['remaining_balance'] . '</td>
    </tr>
  </table>
  <table>
    <thead>
      <th>OR No.</th>
      <th>Date</th>
      <th>Time</th>
      <th>Amount Paid</th>
      <th>Payment Method</th>
    </thead>
    <tbody>';

if (!isset($payments)) {
  echo "<tr><td colspan='4' class='empty-record'>There are no records to display.</td></tr>";
} else {
  foreach ($payments as $payment) {
    $html .= '<tr>
        <td>' . $payment['id'] . '</td>
        <td>' . date("F d, Y", strtotime($payment["payment_date"])) . '</td>
        <td>' . date("h:i:s A", strtotime($payment["payment_date"])) . '</td>
        <td>Php ' . $payment["amount_paid"] . '</td>
        <td>' . $methods[$payment["payment_method"]] . '</td>
      </tr>';
  }
}

$html .= '    </tbody>
      </table>
    </body>
    
    </html>';

echo $html;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$options = $dompdf->getOptions();
$options->setDpi('120');
$options->setDefaultFont('Arial');
$options->setIsRemoteEnabled(true);
$options->setChroot($_SERVER['DOCUMENT_ROOT']);
$dompdf->setOptions($options);
$dompdf->setPaper('letter', 'portait');
$dompdf->render();
// $dompdf->stream();
