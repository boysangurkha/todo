<?php
include_once('../classes/db.php');
include_once('../classes/task.php');
$id = $_GET['id'];
Task::deleteById($id);
header("Location: ../../index.php");
?>