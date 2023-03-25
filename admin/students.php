<?php
require '../config.php';
$page_title = 'Students';


require_once './includes/header.php'
?>

<!-- Main Content -->
<main>
  <div class="card">
    <div class="card-header">
      <div class="filter-group">
        <h4>Search and Filter</h4>
        <div class="filter-group">
          <label for="all" class="radio-control">
            <input type="radio" name="show" id="all" checked>
            Show All
          </label>
          <label for="paid" class="radio-control">
            <input type="radio" name="show" id="paid">
            Paid Accounts
          </label>
          <label for="unpaid" class="radio-control">
            <input type="radio" name="show" id="unpaid">
            Unpaid Accounts
          </label>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="filter-group">
        <input type="text" class="input-control search" placeholder="Student Number" id="">
        <input type="text" class="input-control search" placeholder="Last Name" id="">
        <input type="text" class="input-control search" placeholder="First Name" id="">
        <input type="text" class="input-control search" placeholder="Middle Name" id="">
        <input type="text" class="input-control search" placeholder="Program" id="">
      </div>

    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Student Records</h4>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table>
          <thead>
            <th>No.</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Program</th>
            <th>Amount Paid</th>
            <th>Remaining Balance</th>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Garcia</td>
              <td>Jake</td>
              <td>Perez</td>
              <td>Bachelor of Science in Information Technology</td>
              <td>Php 8,123.50</td>
              <td>Php 0.00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php
require_once './includes/footer.php'
?>