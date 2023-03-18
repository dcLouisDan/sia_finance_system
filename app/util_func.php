<?php


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
