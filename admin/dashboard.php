<?php
$page_title = 'Dashboard';
require_once  './includes/header.php';
require_once '../app/fee_func.php';

$feestotals = fetchFeesTotals($pdo);
$recentLogs = fetchLimitedAuditLog(5, $pdo);
$totalStudents = countItems('tbl_students', $pdo);
$totalUsers = countItems('tbl_finance_users', $pdo);
$totalEmployees = countItems('tbl_employees', $pdo);
?>

<!-- Main Content -->
<main>
  <div class="dash-grid">

    <!-- Card 1 -->
    <div class="card">
      <div class="card-body">
        <div class="dash-counter">
          <div class="counter-label">Number of Students</div>
          <div class="counter-count"><?= $totalStudents['total'] ?></div>
        </div>
      </div>
    </div>
    <!-- Card 1 -->
    <div class="card">
      <div class="card-body">
        <div class="dash-counter">
          <div class="counter-label">Number of Users</div>
          <div class="counter-count"><?= $totalUsers['total'] ?></div>
        </div>
      </div>
    </div>
    <!-- Card 1 -->
    <div class="card">
      <div class="card-body">
        <div class="dash-counter">
          <div class="counter-label">Number of Employees</div>
          <div class="counter-count"><?= $totalEmployees['total'] ?></div>
        </div>
      </div>
    </div>
    <!-- Card 1 -->
    <div class="card full-span">
      <div class="card-header">
        <h4>Recent Activity</h4>
      </div>
      <div class="card-body" style="font-size: 14px;">
        <table>
          <thead>
            <th>User ID</th>
            <th>Date</th>
            <th style="width:70%">Action</th>
          </thead>
          <tbody>
            <?php
            foreach ($recentLogs as $log) {
            ?>
              <tr>
                <td><?= $log["user_id"] ?></td>
                <td><?= $log["action_date"] ?></td>
                <td><?= $log["action_desc"] ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Card 1 -->
    <div class="card">
      <div class="card-header">
        <h4>College Fees Payment Status</h4>
      </div>
      <div class="card-body">
        <div style="width: 100%;"><canvas id="chart1"></canvas></div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script>
  var feestotals = <?php echo json_encode($feestotals); ?>;
  var paid = feestotals.total - feestotals.balance;
  console.table(paid);

  var chart1 = document.getElementById("chart1");
  var graph = new Chart(chart1, {
    type: 'doughnut',
    data: {
      labels: ["Paid fees", "Unpaid Fees", ],
      datasets: [{
        label: "Php",
        data: [paid, feestotals.balance],
      }],
    },
    options: {
      responsive: true,
    },
  });
</script>

<?php
require_once  './includes/footer.php'
?>