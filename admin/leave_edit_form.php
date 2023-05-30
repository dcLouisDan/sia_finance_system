<?php
require '../config.php';
$page_title = 'Edit Employee Leave';

if (!isset($_GET["id"])) {
  header("Location: leave_and_vacation.php");
  exit;
}


require_once './includes/header.php';
require_once '../app/fee_func.php';

$typeList = fetchAll('tbl_leave_type', $pdo);
$employeeList = fetchAll('tbl_employees', $pdo);
$statusList = fetchAll('tbl_leave_status', $pdo);

$leave = fetchItem('tbl_leave', $_GET["id"], $pdo);
$employee = fetchItem('tbl_employees', $leave['employee_id'], $pdo);
?>

<!-- Delete Employee Modal -->
<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">Delete Employee Leave</h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <form action="../app/leave_delete.php" method="post">
        <div class="modal__content" id="modal-1-content">
          <input type="number" name="leave_id" value="<?= $leave["id"] ?>" hidden>
          Are you sure you want to delete this leave record from the system?
        </div>
        <div class="modal__footer">
          <button class="modal__btn modal__btn-primary">Delete Leave</button>
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
  <div class="card">
    <div class="card-header">
      <div class="filter-group">
        <h4>Edit Employee Leave</h4>
        <a href="leave_and_vacation.php"><button class="btn">Cancel</button></a>
      </div>
    </div>
    <div class="card-body">
      <div class="max-width-800">
        <form action="../app/leave_edit.php" method="post">
          <input type="number" name="id" value="<?= $leave['id'] ?>" hidden>
          <div class="fee">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" class="input-control m-0 gray small">
              <?php
              foreach ($employeeList as $employee) {
                if ($employee['id'] == $leave['employee_id']) {
                  echo "<option selected value='" . $employee['id'] . "'>" .  $employee['first_name'] . " " . $employee['last_name'] . "</option>";
                } else {
                  echo "<option value='" . $employee['id'] . "'>" .  $employee['first_name'] . " " . $employee['last_name'] . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="fee">
            <label for="start_date">Start Date:</label>
            <input required type="date" value="<?= $leave['start_date'] ?>" class="input-control gray" name="start_date">
          </div>
          <div class="fee">
            <label for="end_date">End Date:</label>
            <input required type="date" value="<?= $leave['end_date'] ?>" class="input-control gray" name="end_date">
          </div>
          <div class="fee">
            <label for="type_id">Leave Type:</label>
            <select name="leave_type" class="input-control m-0 gray small">
              <option value="">Leave Type</option>
              <?php
              foreach ($typeList as $type) {
                if ($type['id'] == $leave['leave_type']) {
                  echo "<option selected value='" . $type['id'] . "'>" .  $type['name'] . "</option>";
                } else {
                  echo "<option value='" . $type['id'] . "'>" .  $type['name'] . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="fee">
            <label for="first_name">Leave:</label>
            <select name="status_id" class="input-control m-0 gray small">
              <?php
              foreach ($statusList as $status) {
                if ($status['id'] == $leave['status_id']) {
                  echo "<option selected value='" . $status['id'] . "'>" .  $status['name'] . "</option>";
                } else {
                  echo "<option value='" . $status['id'] . "'>" .  $status['name'] . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="edit-btn-group">
            <button type="submit" class="btn">Save</button>
            <button type="button" class="btn small" title="Delete" data-custom-open="modal-1">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php
require_once './includes/footer.php'
?>