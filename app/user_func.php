<?php

function loginFinanceUser(string $email, string $password, int $access_lvl, string $folder, $pdo)
{
  if (notEmpty($email) && notEmpty($password)) {
    $stmt = $pdo->prepare("SELECT * FROM `tbl_finance_users` WHERE email= ? AND password = ? AND access_lvl = ?");
    $stmt->execute([$email, $password, $access_lvl]);

    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();
      $row['full_name'] = $row['first_name'] . " " . $row['last_name'];
      $row['date_created'] = date_parse($row['date_created']);
      $_SESSION['user'] = $row;
      $_SESSION["folder"] = $folder;
      clearPostInputs(['email', 'password']);
      header("Location: ./dashboard.php");
      exit;
    } else {
      echo "<script>alert('Invalid username or password')</script>";
    }
  } else {
    echo "<script>alert('Empty username or password')</script>";
  }
}
