<?php
$page_title = 'Employees';
require_once  './includes/header.php';
require_once '../app/employee_func.php';
require_once '../app/attendance_func.php';
$employees = fetchAll("tbl_employees", $pdo) ?? [];
$getID = 0;
if (isset($_GET["id"])) {
  $getID = $_GET["id"];
  $getEmployee = fetchItem("tbl_employees", $getID, $pdo);
}

$employeeCount = 0;

$date = date("Y-m-d");

if (isset($_GET["date"])) {
  $date = $_GET["date"];
}

$departments = fetchAll('tbl_department', $pdo);
?>


<!-- Delete Employee Modal -->
<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">Delete Employee</h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <form action="../app/employee_delete.php" method="post">
        <div class="modal__content" id="modal-1-content">
          <input type="number" name="employee_id" value="<?= $getEmployee["id"] ?>" hidden>
          <input type="text" name="first_name" value="<?= $getEmployee["first_name"] ?>" hidden>
          <input type="text" name="last_name" value="<?= $getEmployee["last_name"] ?>" hidden>
          Are you sure you want to delete <?= $getEmployee["first_name"] . " " . $getEmployee["last_name"] ?> from the system?
        </div>
        <div class="modal__footer">
          <button class="modal__btn modal__btn-primary">Delete Employee</button>
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
  <div class="card full-span">
    <div class="card-header">
      <div class="filter-group">
        <h4>Record Attendance</h4>
        <form method="get" action="record_attendance.php" id="dateInput">
          <input type="date" placeholder="00/00/0000" name="date" class="input-control gray small" value="<?= $date ?>" onchange="document.getElementById('dateInput').submit()">
        </form>
      </div>
    </div>
    <form action="../app/attendace_record.php" method="post">
      <input type="date" placeholder="00/00/0000" name="date" class="input-control gray small" value="<?= $date ?>" hidden>
      <div class="card-body" style="max-height: 800px; overflow-y: scroll;">
        <table>
          <thead>
            <th style="width: 5%;">ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Status</th>
            <th style="width: 21%;">Time in</th>
            <th style="width: 21%;">Time out</th>
          </thead>
          <tbody>
            <?php
            foreach ($employees as $employee) {
              $employeeCount++;
              $attendace = fetchAttendaceOnEmployeeAndDate($date, $employee['id'], $pdo);
              switch ($attendace['status_id']) {
                case '0':
                  $present = '';
                  $absent = 'checked';
                  break;
                case '1':
                  $present = 'checked';
                  $absent = '';
                  break;
                default:
                  $present = 'checked';
                  $absent = '';
              }
            ?>
              <tr>
                <td><?= $employee['id'] ?></td>
                <td><?= $employee['first_name'] . " " . $employee['last_name'] ?></td>
                <td><?= $departments[$employee['department_id']]['department_name'] ?></td>
                <td>
                  <input type="number" name="<?= $employeeCount ?>_id" value="<?= $employee['id'] ?>" hidden>
                  <label for="paid" class="radio-control">
                    <input name="<?= $employeeCount ?>_status" type="radio" <?= $present ?> value="1">
                    Present
                  </label>
                  <label for="paid" class="radio-control">
                    <input name="<?= $employeeCount ?>_status" type="radio" <?= $absent ?> value="0">
                    Absent
                  </label>
                </td>
                <td>
                  <div class="clock-in">
                    <input step="any" type="time" class="input-control gray small" name="<?= $employeeCount ?>_time_in" value="<?= $attendace['time_in'] ?>">
                    <div class="btn-group">
                      <button class="btn" type="button">
                        <i class="bi bi-clock"></i>
                      </button>
                      <button class="btn" type="button">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="clock-in">
                    <input step="any" type="time" class="input-control gray small" name="<?= $employeeCount ?>_time_out" value="<?= ($attendace['time_out']) ?>">
                    <div class="btn-group">
                      <button class="btn clock" type="button">
                        <i class="bi bi-clock"></i>
                      </button>
                      <button class="btn x" type="button">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
            <input type="number" value="<?= $employeeCount ?>" name="employee_count" hidden>
          </tbody>
        </table>
        <div class="edit-btn-group"><button type="submit" class="btn">Save</button></div>
    </form>
  </div>
  </div>
</main>

<script>
  const clockInInputs = Array.from(document.querySelectorAll('.clock-in'));

  clockInInputs.map(input => {
    var buttons = Array.from(input.querySelectorAll('button'));
    var clockBtn = buttons[0]
    var xBtn = buttons[1];
    var timeInput = input.querySelector('input');

    clockBtn.addEventListener('click', () => {
      var time = new Date().toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      });

      console.log(time)
      timeInput.value = time;
    })

    xBtn.addEventListener('click', () => {
      timeInput.value = '';
    })

  })
</script>

<?php
require_once  './includes/footer.php'
?>