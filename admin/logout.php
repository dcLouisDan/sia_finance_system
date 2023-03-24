<?php
require '../config.php';
require '../app/util_func.php';


session_start();
logAction("Logout", $pdo);
session_destroy();
header("Location: ./index.php");
