<?php
require('connection.php');

$request = json_decode(file_get_contents('php://input'), true);

session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    exit();
}

if (isset($request['tid']) && isset($_SESSION['userid']) && isset($request['task'])) {

    if ($request['task'] == "delete") {
        $query = "DELETE FROM `tags` WHERE `tags`.`tid` = " . $request['tid'] . " and `tags`.`uid` = " . $_SESSION['userid'] . "";
    } else if($request['task'] == "update" && isset($request['update'])) {
        $query = "update tags set name = '" . $request['update'] . "' where tid = " . $request['tid'] . " and uid = " . $_SESSION['userid'] . "";
    }
    $result = mysqli_query($conn, $query);


    if ($result == true) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}
?>