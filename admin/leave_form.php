<?php
require '../config.php';
$page_title = 'New Employee Leave';


require_once './includes/header.php';
require_once '../app/fee_func.php';

$typeList = fetchAll('tbl_leave_type', $pdo);
$employeeList = fetchAll('tbl_employees', $pdo);
$statusList = fetchAll('tbl_leave_status', $pdo);


$type_id = (isset($_GET["type_id"])) ? $_GET["type_id"] : null;
$leaves = fetchAll('tbl_leave', $pdo) ?? [];
?>

<!-- Main Content -->
<main>
  <div class="card">
    <div class="card-header">
      <h4>Add New Employee Leave</h4>
    </div>
    <div class="card-body">
      <div class="max-width-800">
        <form action="../app/leave_add.php" method="post">
          <div class="fee">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" class="input-control m-0 gray small">
              <?php
              foreach ($employeeList as $employee) {
                echo "<option value='" . $employee['id'] . "'>" .  $employee['first_name'] . " " . $employee['last_name'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="fee">
            <label for="start_date">Start Date:</label>
            <input required type="date" value="" class="input-control gray" name="start_date">
          </div>
          <div class="fee">
            <label for="end_date">End Date:</label>
            <input required type="date" value="" class="input-control gray" name="end_date">
          </div>
          <div class="fee">
            <label for="type_id">Leave Type:</label>
            <select name="leave_type" class="input-control m-0 gray small">
              <option value="">Leave Type</option>
              <?php
              foreach ($typeList as $type) {
                if ($type['id'] == $type_id) {
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
                echo "<option value='" . $status['id'] . "'>" .  $status['name'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="edit-btn-group"><button type="submit" class="btn">Save</button></div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php
require_once './includes/footer.php'
?>