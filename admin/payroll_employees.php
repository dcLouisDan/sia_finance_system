<?php
require '../config.php';
require '../app/attendance_func.php';
$page_title = 'Employee Payroll Details';

if (!isset($_GET["id"])) {
  header("Location: ./payroll.php");
  exit;
}

require_once './includes/header.php';


$id = $_GET["id"];
$payroll = fetchItem('tbl_payroll', $id, $pdo) ?? [];

$employee_payrolls = fetchAllItemsOnColumn('tbl_employee_payroll', 'payroll_id', $id, $pdo) ?? [];
?>

<!-- New payroll Modal -->
<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">Delete Payroll</h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <form action="../app/payroll_delete.php" method="post">
        <div class="modal__content" id="modal-1-content">
          <input type="number" value="<?= $id ?>" name="payroll_id" hidden>
          Are you sure you want to delete this payroll list? This action cannot be undone.
        </div>
        <div class="modal__footer">
          <button class="modal__btn modal__btn-primary">Delete Payroll</button>
          <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">
            Close
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Main Content -->

<main>
  <div class="card fit">
    <div class="card-header">
      <div class="filter-group">
        <h4>Employee Payroll Details</h4>
        <a href="payroll.php"><button class="btn">Back</button></a>
      </div>
    </div>
    <div class="card-body p-0">
      <br>
      <div class="input-list">
        <div class="fee">
          <label for="title">Start Date:</label>
          <div class="input-control gray"><?= date("F d, Y", strtotime($payroll['start_date'])) ?></div>
        </div>
        <div class="fee">
          <label for="title">End Date:</label>
          <div class="input-control gray"><?= date("F d, Y", strtotime($payroll['end_date'])) ?></div>
        </div>
      </div>
      <div class="edit-btn-group">
        <button type="button" class="btn small" title="Delete" data-custom-open="modal-1">Delete Payroll</button>
      </div>
      <div class="table-responsive max-500">
        <table>
          <thead>
            <th style="width: 5%;">No.</th>
            <th>Employee Name</th>
            <th>Hours Worked</th>
            <th>Pay per hour</th>
            <th>Final Pay</th>
          </thead>
          <tbody id="studentRows">
            <?php
            foreach ($employee_payrolls as $employee_payroll) {
              $employee = fetchItem('tbl_employees', $employee_payroll['employee_id'], $pdo);
              $hours = countEmployeeAttendance($employee['id'], $payroll['start_date'], $payroll['end_date'], $pdo);
            ?>
              <tr>
                <td><?= $employee_payroll['id'] ?></td>
                <td><?= $employee['first_name'] . " " . $employee['last_name']  ?></td>
                <td><?= $hours ?> hrs</td>
                <td>Php <?= $employee['salary_hour'] ?></td>
                <td>Php <?= $employee_payroll['pay'] ?></td>
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