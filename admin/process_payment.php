<?php
$page_title = 'Process Payment';
require_once  './includes/header.php';
require_once '../app/fee_func.php';
$last_sem = fetchlastItem('tbl_semester', $pdo);
$sem_id = (isset($_GET["sem_id"])) ? $_GET["sem_id"] : $last_sem['id'];
$student = fetchOneStudentRecordOnSem($_GET["id"], $sem_id, $pdo);
$fee = fetchFeeOnStudentCourse($student['student_course_id'], $pdo);
generateStudentCollegeBill($student["student_id"], $sem_id, $pdo);
$semList = fetchAllItemsOnColumn('student_semester_view', 'student_id', $student['student_id'], $pdo);

?>

<!-- Main Content -->
<main>
  <div class="card fit">
    <div class="card-header">
      <div class="filter-group">
        <h4>Student Records</h4>
        <form method="get" id="studentSem">
          <input type="number" name="id" value="<?= $student['student_id'] ?>" hidden>
          <select name="sem_id" class="input-control gray small" onchange="document.getElementById('studentSem').submit()">
            <?php
            foreach ($semList as $sem) {
              if ($sem['sem_id'] == $sem_id) {
                echo "<option selected value='" . $sem['sem_id'] . "'>" . getOrdinal($sem['sem_num']) . " AY " . $sem['start_year'] . "-" . $sem['end_year'] .  "</option>";
              } else {
                echo "<option value='" . $sem['sem_id'] . "'>" . getOrdinal($sem['sem_num']) . " AY " . $sem['start_year'] . "-" . $sem['end_year'] .  "</option>";
              }
            }
            ?>
          </select>
        </form>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive max-500">
        <table>
          <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Program</th>
            <th>Amount</th>
            <th>Remaining Balance</th>
          </thead>
          <tbody id="studentRows">
            <tr>
              <td data-field="studNum"><?= $student['student_id'] ?></td>
              <td data-field="studName">
                <p href="./student.php?id=<?= $student['student_id'] ?>">
                  <?= $student['last_name'] . ", " . $student['first_name'] . " " . $student["middle_name"] ?>
                </p>
              </td>
              <td data-field="studProgram"><?= ucwords(strtolower($student['program_name'])) ?></td>
              <td data-field="studAmount">Php <?= $student['amount'] ?></td>
              <td data-field="studBal">Php <?= $student['remaining_balance'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card fit">
    <div class="card-header">
      <h4>Add Payment</h4>
    </div>
    <div class="card-body">
      <form action="../app/payment_add.php" method="post">
        <input type="number" value="<?= $fee['id'] ?>" name="fee_id" hidden>
        <input type="number" value="<?= $student['student_id'] ?>" name="student_id" hidden>
        <input type="number" value="<?= $student['remaining_balance'] ?>" name="balance" hidden>
        <input type="number" value="<?= $sem_id ?>" name="sem_id" hidden>
        <div class="input-list">
          <div class="fee">
            <label for="">Payment Method:</label>
            <select name="payment_method" class="input-control gray">
              <option value="0">Cash</option>
              <option value="1">Check</option>
            </select>
          </div>
          <div class="fee">
            <label for="">Amount Paid:</label>
            <div class="input-with-currency">
              <div class="currency">Php</div>
              <input type="number" placeholder="0.00" step="0.01" class="input-control gray" value="<?= $fees['tuition_fee'] ?>" name="amount_paid">
            </div>
          </div>
          <div class="edit-btn-group">
            <button type="submit" class="btn positive">Submit</button>
          </div>
      </form>
    </div>
  </div>
</main>

<?php
require_once  './includes/footer.php'
?>