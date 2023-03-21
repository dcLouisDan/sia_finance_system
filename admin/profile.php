<?php
$page_title = 'My Profile';
require_once  './includes/header.php';
?>

<!-- Main Content -->
<main>
  <div class="card">
    <div class="card-header">
      <h4>User Information</h4>
    </div>
    <div class="card-body profile">
      <div class="profile-photo-container">
        <picture class="profile-picture">
          <img srcset="<?= $_SESSION["user"]["profile_photo"] ?>" src="../assets/profile-placeholder.jpg" alt="" class="">
        </picture>
        <!-- <input type="file" class="input-control"> -->
        <button type="button" class="btn btn-sm">Change Profile Photo</button>
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
</main>



<?php
require_once  './includes/footer.php'
?>