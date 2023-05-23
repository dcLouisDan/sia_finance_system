<?php
$page_title = 'Audit Log';
require_once  './includes/header.php';

$recentLogs = fetchAllAuditLogs($pdo);
?>

<!-- Main Content -->
<main>
  <!-- Card 1 -->
  <div class="card full-span">
    <div class="card-header">
      <h4>Audit Log</h4>
    </div>
    <div class="card-body" style="max-height: 800px; overflow-y: scroll;">
      <table>
        <thead>
          <th>User ID</th>
          <th>Date</th>
          <th>Time</th>
          <th style="width:70%">Action</th>
        </thead>
        <tbody>
          <?php
          foreach ($recentLogs as $log) {
          ?>
            <tr>
              <td><?= $log["user_id"] ?></td>
              <td><?= date("F d, Y", strtotime($log["action_date"])) ?></td>
              <td><?= date("h:i:s A", strtotime($log["action_date"])) ?></td>
              <td><?= $log["action_desc"] ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php
require_once  './includes/footer.php'
?>