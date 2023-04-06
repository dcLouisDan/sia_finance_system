<?php

function loginFinanceUser(string $email, string $password, int $access_lvl, string $folder, $pdo)
{
  if (notEmpty($email) && notEmpty($password)) {
    $stmt = $pdo->prepare("SELECT * FROM `tbl_finance_users` WHERE email= ? AND access_lvl = ?");
    $stmt->execute([$email, $access_lvl]);

    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();

      if (password_verify($password, $row['password']) != 1) {
        $_SESSION["alert"] = "Password is incorrect.";
      } else {
        $row['date_created'] = date_parse($row['date_created']);
        $_SESSION['user'] = $row;
        $_SESSION["folder"] = $folder;
        logAction("Login", $pdo);
        clearPostInputs(['email', 'password']);
        header("Location: ./dashboard.php");
        exit;
      }
    } else {
      $_SESSION["alert"] = "Invalid username or password.";
    }
  } else {
    $_SESSION["alert"] = "Empty username or password.";
  }
}

function emailExists($email, $pdo)
{
  $sql = "SELECT * FROM tbl_finance_users WHERE email = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);
  return ($stmt->rowCount() > 0) ? true : false;
}
