<?php
require '../config.php';
$page_title = 'Manage Payroll';


require_once './includes/header.php';

$payrolls = fetchAll('tbl_payroll', $pdo) ?? [];
?>

<!-- New payroll Modal -->
<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">Generate New Payroll</h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <form action="../app/payroll_add.php" method="post">
        <div class="modal__content" id="modal-1-content">
          <div class="fee">
            <label for="start_date">Start Date:</label>
            <input required type="date" value="" class="input-control gray" name="start_date">
          </div>
          <div class="fee">
            <label for="end_date">End Date:</label>
            <input required type="date" value="" class="input-control gray" name="end_date">
          </div>
        </div>
        <div class="modal__footer">
          <button class="modal__btn modal__btn-primary">Save</button>
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
        <h4>Manage Employee Payroll</h4>
        <div class="filter-group">
          <button href="" class="btn small" data-custom-open="modal-1">Generate New Payroll</button>
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
            <th>Action</th>
          </thead>
          <tbody id="studentRows">
            <?php
            foreach ($payrolls as $payroll) {
            ?>
              <tr>
                <td><?= $payroll['id'] ?></td>
                <td><?= date("F d, Y", strtotime($payroll['start_date'])) ?></td>
                <td><?= date("F d, Y", strtotime($payroll['end_date'])) ?></td>
                <td>
                  <div class="btn-group">
                    <a href="payroll_employees.php?id=<?= $payroll['id'] ?>"><button type="button" class="btn small" title="View Payroll Details"><i class="bi bi-eye-fill"></i> View Details</button></a>
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