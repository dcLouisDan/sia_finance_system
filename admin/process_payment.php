<?php
$page_title = 'Process Payment';
require_once  './includes/header.php';
require_once '../app/fee_func.php';
$student = fetchItemOnColumn("student_course_amount_view", 'student_id', $_GET["id"], $pdo);
$fee = fetchFeeOnStudentCourse($student['student_course_id'], $pdo);
generateStudentCollegeBill($student["student_id"], 1, $pdo);
?>

<!-- Main Content -->
<main>
  <div class="card fit">
    <div class="card-header">
      <h4>Student Record</h4>
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