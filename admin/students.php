<?php
require '../config.php';
$page_title = 'Students';


require_once './includes/header.php';
require_once '../app/fee_func.php';
$student_records = fetchAll("student_course_amount_view", $pdo);
?>

<!-- Main Content -->
<main>
  <div class="card fit">
    <div class="card-header">
      <div class="filter-group">
        <h4>Search and Filter</h4>
        <div class="filter-group" id="feeRadFilter">
          <label for="all" class="radio-control">
            <input type="radio" name="show" id="radAll" checked>
            Show All
          </label>
          <label for="paid" class="radio-control">
            <input type="radio" name="show" id="radPaid">
            Paid Accounts
          </label>
          <label for="unpaid" class="radio-control">
            <input type="radio" name="show" id="radUnpaid">
            Unpaid Accounts
          </label>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="filter-group">
        <input type="number" class="input-control search" placeholder="Student Number" id="searchStudNum">
        <input type="text" class="input-control search" placeholder="Name" id="searchStudName">
        <input type="text" class="input-control search" placeholder="Program" id="searchStudProgram">
      </div>

    </div>
  </div>
  <div class="card fit">
    <div class="card-header">
      <h4>Student Records</h4>
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
            <?php
            foreach ($student_records as $student) {
              generateStudentCollegeBill($student["student_id"], 1, $pdo);
            ?>
              <tr>
                <td data-field="studNum"><?= $student['student_id'] ?></td>
                <td data-field="studName">
                  <a href="./student.php?id=<?= $student['student_id'] ?>">
                    <?= $student['last_name'] . ", " . $student['first_name'] . " " . $student["middle_name"] ?>
                  </a>
                </td>
                <td data-field="studProgram"><?= ucwords(strtolower($student['program_name'])) ?></td>
                <td data-field="studAmount">Php <?= $student['amount'] ?></td>
                <td data-field="studBal">Php <?= $student['remaining_balance'] ?></td>
              </tr>

            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php
require_once './includes/footer.php'
?>