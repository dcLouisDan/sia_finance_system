<?php
require '../config.php';
$page_title = 'Employee Leave and Vacations';


require_once './includes/header.php';
require_once '../app/fee_func.php';

$typeList = fetchAll('tbl_leave_type', $pdo);
$statusList = fetchAll('tbl_leave_status', $pdo);

$type_id = (isset($_GET["type_id"])) ? $_GET["type_id"] : null;
$leaves = fetchAll('tbl_leave', $pdo) ?? [];
?>




<!-- Main Content -->

<main>
  <div class="card fit">
    <div class="card-header">
      <div class="filter-group">
        <h4>Employee Leave and Vacations</h4>
        <div class="filter-group">
          <a href="leave_form.php" class="btn small">+ Add New Employee Leave</a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive max-500">
        <table>
          <thead>
            <th style="width: 5%;">No.</th>
            <th>Employee</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Leave Type</th>
            <th>Status</th>
            <th>Edit</th>
          </thead>
          <tbody id="studentRows">
            <?php
            foreach ($leaves as $leave) {
              $employee = fetchItem('tbl_employees', $leave['employee_id'], $pdo);
            ?>
              <tr>
                <td><?= $leave['id'] ?></td>
                <td><?= $employee['first_name'] . " " . $employee['last_name']  ?></td>
                <td><?= date("F d, Y", strtotime($leave['start_date'])) ?></td>
                <td><?= date("F d, Y", strtotime($leave['end_date'])) ?></td>
                <td><?= $typeList[$leave['leave_type'] - 1]['name'] ?></td>
                <td><?= $statusList[$leave['status_id'] - 1]['name'] ?></td>
                <td>
                  <div class="btn-group">
                    <a href="leave_edit_form.php?id=<?= $leave['id'] ?>"><button type="button" class="btn accent small" title="Edit"><i class="bi bi-pencil-square"></i></button></a>
                  </div>
                </td>
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