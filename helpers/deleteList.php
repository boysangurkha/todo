<?php
include_once('../classes/db.php');
include_once('../classes/Lijst.php');
$id = $_GET['id'];
Lijst::deleteById($id);
header("Location: ../../index.php");
?>