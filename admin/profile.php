<?php
$page_title = 'My Profile';
require_once  './includes/header.php';

$auditLog = fetchUserAuditLog($pdo);
?>

<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">Change your Password</h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <form action="../app/user_password_update.php" method="post">
        <div class="modal__content" id="modal-1-content">
          <input type="password" class="input-control gray" placeholder="Enter your current password." name="old_password">
          <input type="password" class="input-control gray" placeholder="Enter new password." name="new_password">
          <input type="password" class="input-control gray" placeholder="Repeat new password." name="repeat_new_password">
        </div>
        <div class="modal__footer">
          <button class="modal__btn modal__btn-primary">Save Changes</button>
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
  <!-- Profile Card -->
  <div class="card fit">
    <div class="card-header">
      <h4>User Information</h4>
    </div>
    <div class="card-body profile">
      <div class="profile-photo-container">
        <picture class="profile-picture">
          <img srcset="<?= $_SESSION["user"]["profile_photo"] ?>" src="../assets/profile-placeholder.jpg" alt="" class="">
        </picture>
        <form action="../app/user_photo_update.php" method="post" id="change-dp-form" enctype="multipart/form-data">
          <input type="text" name="oldPhoto" value="<?= $_SESSION["user"]["profile_photo"] ?>" hidden>
          <input type="file" class="input-control" id="change-dp-input" name="photo">
          <div class="edit-btn-group" id="dp-btn-group">
            <button type="button" class="btn-outline gray btn-sm" id="cancel-dp-btn">Cancel</button>
            <button type="submit" class="btn positive btn-sm" id="save-dp-btn">Save Changes</button>
          </div>
        </form>
        <button type="button" class="btn btn-sm" id="change-dp-btn">Change Profile Photo</button>
        <button type="button" class="btn btn-sm" id="change-dp-btn" data-custom-open="modal-1">Change Password</button>
      </div>
      <form action="../app/user_info_update.php" method="post">
        <div class="user-info" id="input-list">
          <div class="info">
            <label for="first_name">First Name</label>
            <input type="text" class="input-control gray" disabled value="<?= $_SESSION["user"]["first_name"] ?>" name="first_name">
          </div>
          <div class="info">
            <label for="last_name">Last Name</label>
            <input type="text" class="input-control gray" disabled value="<?= $_SESSION["user"]["last_name"] ?>" name="last_name">
          </div>
          <div class="info">
            <label for="email">Email</label>
            <input type="text" class="input-control gray" disabled value="<?= $_SESSION["user"]["email"] ?>" name="email">
          </div>
        </div>
        <div class="edit-btn-group">
          <button type="button" class="btn-outline gray" id="cancel-btn">Cancel</button>
          <button type="submit" class="btn positive" id="save-btn">Save Changes</button>
          <button type="button" class="btn" id="edit-btn">Edit User Information</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card fit">
    <div class="card-header">
      <h4>User History Log</h4>
    </div>
    <div class="card-body p-0" id="user-log">
      <div class="">
        <table>
          <thead>
            <th>Date</th>
            <th>Time</th>
            <th style="width:70%">Action</th>
          </thead>
          <tbody>
            <?php
            foreach ($auditLog as $log) {
            ?>
              <tr>
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
  </div>
</main>



<?php
require_once  './includes/footer.php'
?>