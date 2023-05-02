<?php
$page_title = 'Student Record';
require_once  './includes/header.php';

if (!isset($_GET["id"])) {
  header("Location: ./students.php");
  exit;
}

require_once '../app/fee_func.php';
require_once '../app/payment_func.php';

$student = fetchItem('student_course_view', $_GET["id"], $pdo);
$student_course = fetchItem("tbl_student_course", $student["student_course_id"], $pdo);
$programFees = fetchFeesOnProgram($student_course['program_id'], $pdo);
$fee = fetchFeeOnStudentCourse($student_course['id'], $pdo);
generateStudentCollegeBill($student["id"], 1, $pdo);

$payments = fetchStudentPaymentHistory($student['id'], $pdo);
?>

<!-- Main Content -->
<main>
  <div class="user-list">
    <div class="card">
      <div class="card-header with-btn">
        <a href="./students.php"><i class="bi bi-box-arrow-left"></i></a>
        <h4>Student Record</h4>
      </div>
      <div class="card-body p-0">
        <div class="info-item">
          <p class="info-label">Student Number:</p>
          <p class="info-text"><?= $student['id'] ?></p>
        </div>
        <div class="info-item">
          <p class="info-label">First Name:</p>
          <p class="info-text"><?= $student['first_name'] ?></p>
        </div>
        <div class="info-item">
          <p class="info-label">Middle Name:</p>
          <p class="info-text"><?= $student['middle_name'] ?></p>
        </div>
        <div class="info-item">
          <p class="info-label">Last Name:</p>
          <p class="info-text"><?= $student['last_name'] ?></p>
        </div>
        <div class="info-item">
          <p class="info-label">Program Name:</p>
          <p class="info-text"><?= ucwords(strtolower($student['program_name'])) ?></p>
        </div>
        <div class="info-item">
          <p class="info-label">Number of Units:</p>
          <p class="info-text"><?= $student['units'] ?></p>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4>Fees Breakdown</h4>
      </div>
      <div class="card-body p-0">
        <table>
          <tbody>
            <tr>
              <td class="info-label">Tuition Fee (<?= $student['units'] ?> units)</td>
              <td>Php <?= number_format((float)$programFees['tuition_fee'] * $student['units'], 2, '.', ''); ?></td>
            </tr>
            <tr>
              <td class="info-label">Miscellaneous Fee</td>
              <td>Php <?= $programFees['misc_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label">Registration Fee</td>
              <td>Php <?= $programFees['registration_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label">Library Fee</td>
              <td>Php <?= $programFees['library_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label">Laboratory Fee</td>
              <td>Php <?= $programFees['laboratory_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label">Guidance Fee</td>
              <td>Php <?= $programFees['guidance_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label">Computer Fee</td>
              <td>Php <?= $programFees['computer_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label">Athletic Fee</td>
              <td>Php <?= $programFees['athletic_fee'] ?></td>
            </tr>
            <tr>
              <td class="info-label" style="font-weight: 700;">Total</td>
              <td style="font-weight: 700;">Php <?= $fee['amount'] ?></td>
            </tr>
            <tr>
              <td class="info-label" style="font-weight: 700;">Remaining Balance</td>
              <td style="font-weight: 700;">Php <?= $fee['remaining_balance'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card fit full-span">
      <div class="card-header">
        <div class="filter-group">
          <h4>Payment History</h4>
          <div class="filter-group">
            <a href="process_payment.php?id=<?= $student['id'] ?>" class="btn">Add Payment</a>
          </div>
        </div>
      </div>
      <div class="card-body p-0" id="user-log">
        <div class="">
          <table>
            <thead>
              <th>Date</th>
              <th>Time</th>
              <th>Amount Paid</th>
              <th>Payment Method</th>
            </thead>
            <tbody>
              <?php
              if (!isset($payments)) {
                echo "<tr><td colspan='4' class='empty-record'>There are no records to display.</td></tr>";
              } else {
                foreach ($payments as $payment) {
              ?>
                  <tr>
                    <td><?= date("F d, Y", strtotime($payment["payment_date"])) ?></td>
                    <td><?= date("h:i:s A", strtotime($payment["payment_date"])) ?></td>
                    <td>Php <?= $payment["amount_paid"] ?></td>
                    <td><?= $methods[$payment["payment_method"]] ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</main>

<?php
require_once  './includes/footer.php'
?>