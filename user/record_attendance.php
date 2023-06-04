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
    <form action="../app/attendance_record.php" method="post">
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
              $attendance = fetchAttendanceOnEmployeeAndDate($date, $employee['id'], $pdo) ?? [
                'time_in' => null,
                'time_out' => null,
                'status_id' => '0'
              ];
              switch ($attendance['status_id']) {
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
                    <input step="any" type="time" class="input-control gray small" name="<?= $employeeCount ?>_time_in" value="<?= $attendance['time_in'] ?>">
                    <div class="btn-group">
                      <button class="btn" type="button" title="Current Time">
                        <i class="bi bi-clock"></i>
                      </button>
                      <button class="btn" type="button" title="Clear">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="clock-in">
                    <input step="any" type="time" class="input-control gray small" name="<?= $employeeCount ?>_time_out" value="<?= ($attendance['time_out']) ?>">
                    <div class="btn-group">
                      <button class="btn clock" type="button" title="Current Time">
                        <i class="bi bi-clock"></i>
                      </button>
                      <button class="btn x" type="button" title="Clear">
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