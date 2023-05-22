<?php
$page_title = 'Employees';
require_once  './includes/header.php';
require_once '../app/employee_func.php';
$employees = fetchAll("tbl_employees", $pdo) ?? [];
$getID = 0;
if (isset($_GET["id"])) {
  $getID = $_GET["id"];
  $getEmployee = fetchItem("tbl_employees", $getID, $pdo);
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
  <div class="user-list">
    <div class="card">
      <div class="card-header">
        <div class="input-with-icon">
          <i class="bi bi-search"></i>
          <input type="text" class="input-control search" placeholder="Search" id="program-search">
        </div>
      </div>
      <div class="">
        <ul class="card-list" id="program-list">
          <li>
            <a href="employees.php" class="<?php echo (!isset($_GET["id"])) ?  'active' : '' ?>">+ Add New Employee</a>
          </li>
          <?php
          foreach ($employees as $employee) {
          ?>
            <li><a href='<?= "./employees.php?id=" . $employee['id'] ?>' class="<?php echo ($getID == $employee['id']) ?  'active' : '' ?> user-list-item">
                <img srcset="<?= $employee["profile_photo"] ?>" src="../assets/profile-placeholder.jpg" alt="" class="display-photo">
                <div class="user-account">
                  <p class="employeename"><?= $employee['first_name'] . " " . $employee['last_name']; ?></p>
                </div>
              </a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <?php if (isset($_GET["id"])) { ?>
      <div class="card">
        <div class="card-header">
          <h4>Employee Information</h4>
        </div>
        <div class="card-body">
          <div class="profile-photo-container" style="margin-bottom: 2rem;">
            <picture class="profile-picture">
              <img srcset="<?= $getEmployee["profile_photo"] ?>" src="../assets/profile-placeholder.jpg" alt="" class="">
            </picture>
            <form action="../app/employee_photo_update.php" method="post" id="change-dp-form" enctype="multipart/form-data">
              <input type="text" name="oldPhoto" value="<?= $getEmployee["profile_photo"] ?>" hidden>
              <input type="number" name="employee_id" value="<?= $getEmployee['id'] ?>" hidden>
              <input type="file" class="input-control" id="change-dp-input" name="photo">
              <div class="edit-btn-group" id="dp-btn-group">
                <button type="button" class="btn-outline gray btn-sm" id="cancel-dp-btn">Cancel</button>
                <button type="submit" class="btn positive btn-sm" id="save-dp-btn">Save Changes</button>
              </div>
            </form>
            <button type="button" class="btn btn-sm" id="change-dp-btn">Change Profile Photo</button>
          </div>
          <form action="../app/employee_update.php" method="post">
            <input type="number" value="<?= $getID ?>" name="employee_id" hidden>
            <div class="input-list" id="input-list">
              <div class="fee">
                <label for="first_name">First Name:</label>
                <input disabled required type="text" placeholder="Enter First Name..." class="input-control gray" name="first_name" value="<?= $getEmployee['first_name'] ?>">
              </div>
              <div class="fee">
                <label for="middle_name">Middle Name:</label>
                <input disabled required type="text" placeholder="Enter Middle Name..." class="input-control gray" name="middle_name" value="<?= $getEmployee['middle_name'] ?>">
              </div>
              <div class="fee">
                <label for="last_name">Last Name:</label>
                <input disabled required type="text" placeholder="Enter Last Name..." class="input-control gray" name="last_name" value="<?= $getEmployee['last_name'] ?>">
              </div>
              <div class="fee">
                <label for="birthday">Birthday:</label>
                <input disabled required type="date" placeholder="Enter Last Name..." class="input-control gray" name="birthday" value="<?= $getEmployee['birthday'] ?>">
              </div>
              <div class="fee">
                <label for="address">Address:</label>
                <input disabled required type="text" placeholder="Enter Employee address..." class="input-control gray" name="address" value="<?= $getEmployee['address'] ?>">
              </div>
              <div class="fee">
                <label for="email">Email:</label>
                <input disabled required type="email" placeholder="Enter User Email..." class="input-control gray" name="email" value="<?= $getEmployee['email'] ?>">
              </div>
              <div class="fee">
                <label for="title">Title:</label>
                <input disabled required type="text" placeholder="Enter Employee title..." class="input-control gray" name="title" value="<?= $getEmployee['title'] ?>">
              </div>
              <div class="fee">
                <label for="department_id">Department</label>
                <select disabled name="department_id" class="input-control gray">
                  <?php
                  foreach ($departments as $dep) {
                    $selected = ($dep['id'] == $getEmployee['department_id']) ? 'selected' : "";
                    echo "<option " . $selected . " value='" . $dep['id'] . "'>" . $dep['department_name'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="fee">
                <label for="title">Date Hired:</label>
                <div class="input-control gray"><?= date("F d, Y", strtotime($getEmployee["hire_date"])) ?></div>
              </div>
            </div>
            <div class="edit-btn-group">
              <button type="button" class="btn-outline gray" id="cancel-btn">Cancel</button>
              <button type="submit" class="btn positive" id="save-btn">Save Changes</button>
              <button type="button" class="btn" id="edit-btn">Edit</button>
              <button type="button" class="btn" data-custom-open="modal-1">Delete User</button>
            </div>
          </form>
        </div>
      </div>
    <?php } else { ?>
      <div class="card">
        <div class="card-header">
          <h4>Add New Employee</h4>
        </div>
        <div class="card-body">
          <div class="program-label">
            <p>Enter employee information.</p>
          </div>
          <form action="../app/employee_add.php" method="post">
            <div class="input-list" id="input-list">
              <div class="fee">
                <label for="first_name">First Name:</label>
                <input required type="text" placeholder="Enter First Name..." class="input-control gray" name="first_name">
              </div>
              <div class="fee">
                <label for="middle_name">Middle Name:</label>
                <input required type="text" placeholder="Enter Middle Name..." class="input-control gray" name="middle_name">
              </div>
              <div class="fee">
                <label for="last_name">Last Name:</label>
                <input required type="text" placeholder="Enter Last Name..." class="input-control gray" name="last_name">
              </div>
              <div class="fee">
                <label for="birthday">Birthday:</label>
                <input required type="date" placeholder="Enter Last Name..." class="input-control gray" name="birthday">
              </div>
              <div class="fee">
                <label for="address">Address:</label>
                <input required type="text" placeholder="Enter Employee address..." class="input-control gray" name="address">
              </div>
              <div class="fee">
                <label for="email">Email:</label>
                <input required type="email" placeholder="Enter User Email..." class="input-control gray" name="email">
              </div>
              <div class="fee">
                <label for="title">Title:</label>
                <input required type="text" placeholder="Enter Employee title..." class="input-control gray" name="title">
              </div>
              <div class="fee">
                <label for="">Department:</label>
                <select name="department_id" class="input-control gray">
                  <?php
                  foreach ($departments as $dep) {
                    echo "<option value='" . $dep['id'] . "'>" . $dep['department_name'] . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="edit-btn-group">
              <button type="submit" class="btn positive">Save</button>
            </div>
          </form>
        </div>
      </div>
    <?php } ?>

  </div>
</main>

<?php
require_once  './includes/footer.php'
?>