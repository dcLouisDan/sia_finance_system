<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
  <title><?= $page_title ?> - DHVSU Finance Office</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- JS -->
  <script defer src="../js/app.js"></script>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
  <header class="header">
    <a href="" class="brand">
      <img src="../icon.png" alt="" class="logo">
      <div class="site-name">
        <p class="school">DHVSU</p>
        <p class="office">Finance Office</p>
      </div>
    </a>

    <div class="header-icon">
      <i class="bi bi-gear-fill"></i>
    </div>

    <div class="header-icon">
      <i class="bi bi-bell-fill"></i>
    </div>


    <div class="header-user">
      <div class="user-account">
        <a href="" class="username">
          <p>Juan Dela Cruz</p>
        </a>
        <a href="" class="logout">Logout</a>
      </div>
      <img src="../assets/profile-placeholder.jpg" alt="" class="display-photo">
    </div>
  </header>


  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <ul>
        <li>
          <a class="nav-link" href="dashboard.php">
            Dashboard
          </a>
        </li>
      </ul>

      <h5>Student Fees</h5>
      <ul>
        <li>
          <button type="button" class="nav-menu-btn" href="">
            <i class="bi bi-caret-down-fill"></i>Students
          </button>

          <ul class="nav-menu">
            <li><a href="">Link 1</a></li>
            <li><a href="">Link 2</a></li>
            <li><a href="">Link 3</a></li>
          </ul>
        </li>
        <li>
          <a class="nav-link" href="">
            Programs
          </a>
        </li>
        <li>
          <a class="nav-link" href="">
            Fees
          </a>
        </li>
      </ul>

      <h5>Employee Payroll</h5>
      <ul>
        <li>
          <a class="nav-link" href="">
            Employees
          </a>
        </li>
        <li>
          <a class="nav-link" href="">
            Manage Salaries
          </a>
        </li>
        <li>
          <a class="nav-link" href="">
            Time & Attendance
          </a>
        </li>
      </ul>

      <h5>Reports</h5>
      <ul>
        <li>
          <a class="nav-link" href="">
            Financial Reports
          </a>
        </li>
        <li>
          <a class="nav-link" href="">
            Audit log
          </a>
        </li>
      </ul>

      <img src="../icon.png" class="logo" alt="">
    </div>