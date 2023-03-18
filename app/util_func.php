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
