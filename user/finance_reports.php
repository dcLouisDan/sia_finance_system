<?php
require '../config.php';
$page_title = 'Financial Reports';


require_once './includes/header.php';
require_once '../app/fee_func.php';

$semList = fetchAll('tbl_semester', $pdo);

$last_sem = fetchlastItem('tbl_semester', $pdo);
$sem_id = (isset($_GET["sem_id"])) ? $_GET["sem_id"] : $last_sem['id'];
$semester = fetchItem('tbl_semester', $sem_id, $pdo);
$student_records = fetchStudentRecordsOnSem($sem_id, $pdo);
$program_fee_reports = fetchFeesReportOnSem($sem_id, $pdo);
?>

<!-- Main Content -->
<main>
  <div class="card fit">
    <div class="card-header">
      <div class="filter-group">
        <h4>Financial Reports</h4>
        <div class="filter-group">
          <form method="get" id="selectSubmit">
            <select name="sem_id" class="input-control gray small" onchange="document.getElementById('selectSubmit').submit()" style="margin-bottom: 0;">
              <?php
              foreach ($semList as $sem) {
                if ($sem['id'] == $sem_id) {
                  echo "<option selected value='" . $sem['id'] . "'>" . getOrdinal($sem['sem_num']) . " AY " . $sem['start_year'] . "-" . $sem['end_year'] .  "</option>";
                } else {
                  echo "<option value='" . $sem['id'] . "'>" . getOrdinal($sem['sem_num']) . " AY " . $sem['start_year'] . "-" . $sem['end_year'] .  "</option>";
                }
              }
              ?>
            </select>
          </form>
          <a href="<?= "../app/finance_report_csv.php?sem_id=" . $sem_id ?>"><button class="btn">Export to CSV</button></a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive max-500">
        <table>
          <thead>
            <tr>
              <th colspan="4" style="background-color: var(--background); text-align:center;">College Fees ( <?= getOrdinal($semester['sem_num']) . " Semester AY " . $semester['start_year'] . "-" . $semester['end_year'] ?> )</th>
            </tr>
            <tr>
              <th style="width: 40%;">Program</th>
              <th>Paid Fees</th>
              <th>Unpaid Fees</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="studentRows">
            <?php
            $paid_total = 0;
            $remain_total = 0;
            $total_total = 0;
            foreach ($program_fee_reports as $program) {
              $paid_amount = $program['amount'] - $program['remaining_balance'];
              $paid_total += $paid_amount;
              $remain_total += $program['remaining_balance'];
              $total_total += $program['amount'];
            ?>
              <tr>
                <td><?= $program['program_name'] ?></td>
                <td>Php <?= number_format((float)$paid_amount, 2, '.', '') ?></td>
                <td>Php <?= $program['remaining_balance'] ?></td>
                <td>Php <?= $program['amount'] ?></td>
              </tr>
            <?php
            }
            ?>
            <tr class=".total-row">
              <td><strong>Total</strong></td>
              <td><strong>Php <?= number_format((float)$paid_total, 2, '.', '') ?></strong></td>
              <td><strong>Php <?= number_format((float)$remain_total, 2, '.', '') ?></strong></td>
              <td><strong>Php <?= number_format((float)$total_total, 2, '.', '') ?></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php
require_once './includes/footer.php'
?>