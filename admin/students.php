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
        <div class="filter-group" id="feeRadFilter">
          <label for="all" class="radio-control">
            <input type="radio" name="show" id="radAll" checked>
            Show All
          </label>
          <label for="paid" class="radio-control">
            <input type="radio" name="show" id="radPaid">
            Paid Accounts
          </label>
          <label for="unpaid" class="radio-control">
            <input type="radio" name="show" id="radUnpaid">
            Unpaid Accounts
          </label>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="filter-group">
        <input type="number" class="input-control search" placeholder="Student Number" id="searchStudNum">
        <input type="text" class="input-control search" placeholder="Name" id="searchStudName">
        <input type="text" class="input-control search" placeholder="Program" id="searchStudProgram">
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
            <th>Name</th>
            <th>Program</th>
            <th>Amount Paid</th>
            <th>Remaining Balance</th>
          </thead>
          <tbody id="studentRows">
            <tr>
              <td data-field="studNum">1</td>
              <td data-field="studName">Garcia, Jake Perez</td>
              <td data-field="studProgram">Bachelor of Science in Information Technology</td>
              <td data-field="studPaid">Php 8,123.50</td>
              <td data-field="studBal">Php 0.00</td>
            </tr>
            <tr>
              <td data-field="studNum">2</td>
              <td data-field="studName">Dela Cruz, Maria Gomez</td>
              <td data-field="studProgram">Bachelor of Science in Computer Science</td>
              <td data-field="studPaid">Php 0.00</td>
              <td data-field="studBal">Php 8,123.50</td>
            </tr>
            <tr>
              <td data-field="studNum">3</td>
              <td data-field="studName">Padilla, Mark John Javier</td>
              <td data-field="studProgram">Bachelor of Science in Information Technology</td>
              <td data-field="studPaid">Php 3,000.00</td>
              <td data-field="studBal">Php 5,123.50</td>
            </tr>
            <tr>
              <td data-field="studNum">1</td>
              <td data-field="studName">Garcia, Jake Pereq</td>
              <td data-field="studProgram">Bachelor of Science in Information Technology</td>
              <td data-field="studPaid">Php 8,123.50</td>
              <td data-field="studBal">Php 0.00</td>
            </tr>
            <tr>
              <td data-field="studNum">2</td>
              <td data-field="studName">Dela Cruz, Maria Gomez</td>
              <td data-field="studProgram">Bachelor of Science in Computer Science</td>
              <td data-field="studPaid">Php 0.00</td>
              <td data-field="studBal">Php 8,123.50</td>
            </tr>
            <tr>
              <td data-field="studNum">3</td>
              <td data-field="studName">Padilla, Mark John Javier</td>
              <td data-field="studProgram">Bachelor of Science in Information Technology</td>
              <td data-field="studPaid">Php 3,000.00</td>
              <td data-field="studBal">Php 5,123.50</td>
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