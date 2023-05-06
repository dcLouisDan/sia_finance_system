<?php

function getOrdinal($number)
{
  $suffix = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
  if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
    $ordinal = $number . 'th';
  } else {
    $ordinal = $number . $suffix[$number % 10];
  }

  return $ordinal;
}

function notEmpty($str)
{
  if (isset($str) && $str !== '') {
    return true;
  }
}

function clearPostInputs($arr)
{
  foreach ($arr as $value) {
    unset($_POST[$value]);
  }
}

function fetchAll(string $table, $pdo)
{
  $sql = "SELECT * FROM $table";
  $stmt = $pdo->query($sql);
  return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;
}

function fetchItem(string $table, $id, $pdo)
{
  $sql = "SELECT * FROM $table WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function fetchlastItem(string $table, $pdo)
{
  $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1
  ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function fetchItemOnColumn(string $table, string $column, $id, $pdo)
{
  $sql = "SELECT * FROM $table WHERE $column = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}

function fetchAllItemsOnColumn(string $table, string $column, $id, $pdo)
{
  $sql = "SELECT * FROM $table WHERE $column = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : null;
}

function logAction(string $desc, $pdo)
{
  $user_id = $_SESSION["user"]["id"];
  $stmt = $pdo->prepare("INSERT INTO `tbl_finance_audit_log`(`user_id`, `action_desc`) VALUES (?, ?)");
  $stmt->execute([$user_id, $desc]);
}

function fetchUserAuditLog($pdo)
{
  $user_id = $_SESSION["user"]["id"];
  $sql = "SELECT * FROM `tbl_finance_audit_log` WHERE user_id = ? ORDER BY id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$user_id]);
  if ($stmt->rowCount() > 0) {
    $data = $stmt->fetchAll();

    foreach ($data as $row) {
      $row["action_date"] = date_parse($row["action_date"]);
    }

    return $data;
  }
}
