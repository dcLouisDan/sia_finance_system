<?php
$page_title = 'Manage Users';
require_once  './includes/header.php';
$users = fetchAll("tbl_finance_users", $pdo);
$getID = 0;
if (isset($_GET["id"])) {
  $getID = $_GET["id"];
  $getUser = fetchItem("tbl_finance_users", $getID, $pdo);
}

$access_role = array("Admin", "User",);
?>


<!-- Delete User Modal -->
<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">Delete User</h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <form action="../app/user_admin_delete.php" method="post">
        <div class="modal__content" id="modal-1-content">
          <input type="number" name="user_id" value="<?= $getUser["id"] ?>" hidden>
          <input type="text" name="first_name" value="<?= $getUser["first_name"] ?>" hidden>
          <input type="text" name="last_name" value="<?= $getUser["last_name"] ?>" hidden>
          Are you sure you want to delete <?= $getUser["first_name"] . " " . $getUser["last_name"] ?> from the system?
        </div>
        <div class="modal__footer">
          <button class="modal__btn modal__btn-primary">Delete User</button>
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
            <a href="manage_users.php" class="<?php echo (!isset($_GET["id"])) ?  'active' : '' ?>">+ Add New User</a>
          </li>
          <?php
          foreach ($users as $user) {
          ?>
            <li><a href='<?= "./manage_users.php?id=" . $user['id'] ?>' class="<?php echo ($getID == $user['id']) ?  'active' : '' ?> user-list-item">
                <img srcset="<?= $user["profile_photo"] ?>" src="../assets/profile-placeholder.jpg" alt="" class="display-photo">
                <div class="user-account">
                  <p class="username"><?= $user['first_name'] . " " . $user['last_name']; ?></p>
                  <p class="logout"><?= $access_role[$user["access_lvl"]] ?></p>
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
          <h4>User Information</h4>
        </div>
        <div class="card-body">
          <div class="profile-photo-container" style="margin-bottom: 2rem;">
            <picture class="profile-picture">
              <img srcset="<?= $getUser["profile_photo"] ?>" src="../assets/profile-placeholder.jpg" alt="" class="">
            </picture>
          </div>
          <form action="../app/user_admin_update.php" method="post">
            <input type="number" value="<?= $getID ?>" name="user_id" hidden>
            <div class="input-list" id="input-list">
              <div class="fee">
                <label for="">Access Level</label>
                <select disabled name="access_lvl" class="input-control gray">
                  <option <?php echo ($getUser['access_lvl'] == 0) ?  'selected' : '' ?> value="0">Administrator</option>
                  <option <?php echo ($getUser['access_lvl'] == 1) ?  'selected' : '' ?> value="1">User</option>
                </select>
              </div>
              <div class="fee">
                <label for="first_name">First Name:</label>
                <input disabled required type="text" value="<?= $getUser['first_name'] ?>" class="input-control gray" name="first_name">
              </div>
              <div class="fee">
                <label for="last_name">Last Name:</label>
                <input disabled required type="text" value="<?= $getUser['last_name'] ?>" class="input-control gray" name="last_name">
              </div>
              <div class="fee">
                <label for="email">Email:</label>
                <input disabled required type="email" value="<?= $getUser['email'] ?>" class="input-control gray" name="email">
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
          <h4>Add New User</h4>
        </div>
        <div class="card-body">
          <div class="program-label">
            <p>Enter user information.</p>
          </div>
          <form action="../app/user_add.php" method="post">
            <div class="input-list" id="input-list">
              <div class="fee">
                <label for="">Access Level</label>
                <select name="access_lvl" class="input-control gray">
                  <option value="0">Administrator</option>
                  <option value="1">User</option>
                </select>
              </div>
              <div class="fee">
                <label for="first_name">First Name:</label>
                <input required type="text" placeholder="Enter First Name..." class="input-control gray" name="first_name">
              </div>
              <div class="fee">
                <label for="last_name">Last Name:</label>
                <input required type="text" placeholder="Enter Last Name..." class="input-control gray" name="last_name">
              </div>
              <div class="fee">
                <label for="email">Email:</label>
                <input required type="email" placeholder="Enter User Email..." class="input-control gray" name="email">
              </div>
              <div class="fee">
                <label for="password">Password:</label>
                <input required type="password" placeholder="Enter Password..." class="input-control gray" name="password">
              </div>
              <div class="fee">
                <label for="repeat_password">Repeat Password:</label>
                <input required type="password" placeholder="Enter Password again..." class="input-control gray" name="repeat_password">
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