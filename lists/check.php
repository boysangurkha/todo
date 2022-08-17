<?php
include_once("../classes/Db.php");

$id = $_GET["id"];
$check = $_GET["check"];

echo $check;


$conn = Db::getInstance();



if ($check == 1) {
    $sql = "UPDATE tasks SET checked = 0 WHERE id = $id";
    $result = $conn->query($sql);
} else {
    $sql = "UPDATE tasks SET checked = 1 WHERE id = $id";
    $result = $conn->query($sql);
}

header("location:javascript://history.go(-1)");