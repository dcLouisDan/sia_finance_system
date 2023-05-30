<?php
require '../config.php';
$page_title = 'Manage Payroll';


require_once './includes/header.php';

$payrolls = [1];
?>




<!-- Main Content -->

<main>
  <div class="card fit">
    <div class="card-header">
      <div class="filter-group">
        <h4>Manage Employee Payroll</h4>
        <div class="filter-group">
          <a href="leave_form.php" class="btn small">Generate New Payroll</a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive max-500">
        <table>
          <thead>
            <th style="width: 5%;">No.</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Edit</th>
          </thead>
          <tbody id="studentRows">
            <?php
            foreach ($payrolls as $payroll) {
            ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <div class="btn-group">
                    <a href="leave_edit_form.php?id=<?= $leave['id'] ?>"><button type="button" class="btn small" title="Edit"><i class="bi bi-eye-fill"></i> View Details</button></a>
                    <a href="leave_edit_form.php?id=<?= $leave['id'] ?>"><button type="button" class="btn accent small" title="Edit"><i class="bi bi-pencil-square"></i> Edit</button></a>
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