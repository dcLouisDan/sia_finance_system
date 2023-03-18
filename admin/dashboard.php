<?php
$page_title = 'Dashboard';
require_once  './includes/header.php'
?>

<!-- Main Content -->
<main class="main">
  <?= $_SESSION['user']['email'] ?>
</main>

<?php
require_once  './includes/footer.php'
?>