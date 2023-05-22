<?php
session_start();
require_once './util_func.php';
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $id = $_POST['employee_id'];
  $oldPhoto = $_POST['oldPhoto'];
  $folder = $_SESSION["folder"];

  if (isset($_FILES['photo']['name']) and !empty($_FILES['photo']['name'])) {
    $image_name = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $error = $_FILES['photo']['error'];

    if ($error === 0) {
      $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
      $img_ex_to_lc = strtolower($img_ex);
      $allowed_exs = array('jpg', 'jpeg', 'png');

      if (in_array($img_ex_to_lc, $allowed_exs)) {
        $new_img_name = uniqid($id, true) . "." . $img_ex_to_lc;
        $img_upload_path = '../uploads/profile_photos/' . $new_img_name;

        $old_pp_des = $oldPhoto;

        if (unlink($old_pp_des)) {
          move_uploaded_file($tmp_name, $img_upload_path);
        } else {
          move_uploaded_file($tmp_name, $img_upload_path);
        }

        $stmt = $pdo->prepare("UPDATE tbl_employees 
        SET profile_photo = ? WHERE id = ?");
        if ($stmt->execute([$img_upload_path, $id])) {
          logAction("Updated profile photo of Employee No. $id.", $pdo);


          $_SESSION["alert"] = "Profile Photo updated successfuly.";
          header("Location: ../$folder/employees.php?id=$id");
          exit;
        } else {
          $folder = $_SESSION["folder"];
          $_SESSION["alert"] = "Something went wrong.";
          header("Location: ../$folder/employees.php?id=$id");
          exit;
        }
      } else {
        $folder = $_SESSION["folder"];
        $_SESSION["alert"] = "Unsupported file type.";
        header("Location: ../$folder/employees.php?id=$id");
        exit;
      }
    }
  } else {
    $folder = $_SESSION["folder"];
    $_SESSION["alert"] = "Something went wrong.";
    header("Location: ../$folder/employees.php?id=$id");
    exit;
  }
} else {
  $folder = $_SESSION["folder"];
  $_SESSION["alert"] = "Something went wrong.";
  header("Location: ../$folder/employees.php?id=$id");
  exit;
}
