<?php


include_once("../classes/Db.php");
$id = $_GET["id"];

$conn = Db::getInstance();

$sql = "UPDATE tasks SET uploads = NULL WHERE id = $id";
$result = $conn->query($sql);
header("Location: ../tasks/?id=$id");
