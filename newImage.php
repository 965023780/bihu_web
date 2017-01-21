<?php
include("connect.php");
include("token.php");

$uid = checkToken($pdo, $_POST["token"]);

$url = $_POST["url"];
$type = (int)$_POST["type"];
$id = (int)$_POST["id"];

$sql = null;

switch ($type) {
    case $TYPE_QUESTION:
        $sql = $pdo->prepare("INSERT INTO image ( `uid`, `qid`, `url` ) VALUE ( ?, ?, ? )");
        break;
    case $TYPE_ANSWER:
        $sql = $pdo->prepare("INSERT INTO image ( `uid`, `aid`, `url` ) VALUE ( ?, ?, ? )");
        break;
    default:
        other_encode(400, "类型有误");
}

if ($sql && $sql->execute(array($uid, $id, $url))) {
    success_encode();
} else {
    other_encode(500, "上传失败");
}
