<?php
require_once '../config.php';
require_once '../app/user_func.php';
require_once '../app/util_func.php';
session_start();


if (isset($_SESSION["user"])) {
  header("Location: dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  loginFinanceUser($_POST["email"], $_POST["password"],  0, 'admin', $pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
  <title>Login - DHVSU Finance Office</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/toastify.css">

  <!-- JS -->
  <script defer src="../js/micromodal.min.js"></script>
  <script defer type="module" src="../js/app.js"></script>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-centered">
    <div class="login-card">
      <div class="brand">
        <img src="../icon.png" alt="" class="logo">
        <div class="site-name">
          <p class="school">DHVSU</p>
          <p class="office">Finance Office</p>
        </div>
      </div>
      <h1>
        Welcome.
      </h1>
      <form method="post">
        <div>
          <input class="input-control" type="email" placeholder="Email" name="email" required>
        </div>
        <div>
          <input class="input-control" type="password" placeholder="Password" name="password" required>
        </div>

        <input type="submit" class="btn-wide" value="Login">
      </form>
    </div>
  </div>

  <script type="module">
    import Toastify from "../js/toastify-es.js";

    let sessionAlert = Toastify({
      text: "<?= $_SESSION["alert"] ?>",
      duration: 3000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        background: "var(--accent)",
      },
      offset: {
        y: 30
      },
      onClick: function() {}, // Callback after click
    });

    <?php
    if (isset($_SESSION["alert"])) {
      echo "sessionAlert.showToast()";
      unset($_SESSION["alert"]);
    }
    ?>
  </script>
</body>

</html>