<?php
function fetchFeesOnProgram($program_id, $pdo)
{
  $sql = "SELECT * FROM tbl_fee_struc WHERE program_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$program_id]);
  return ($stmt->rowCount() > 0) ? $stmt->fetch() : null;
}
