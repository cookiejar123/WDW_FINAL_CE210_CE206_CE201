<?php
require('./connection.php');

session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    echo "<br>";
    echo "Error: ".mysqli_error($conn);
    exit();
}

if(!isset($_REQUEST['cid'])){
    echo "cid is not set";
    echo "<br>";
    echo "Error: ".mysqli_error($conn);
    exit();
}

function begin()
{
    global $conn;
    mysqli_query($conn, "BEGIN");
}

function commit()
{
    global $conn;
    mysqli_query($conn, "COMMIT");
}

function rollback()
{
    global $conn;
    mysqli_query($conn, "ROLLBACK");
}


$query = "delete from cookie where cid='".$_REQUEST['cid']."' and uid='".$_SESSION['userid']."'";
$query2 = "delete from cookie_msg where cid='".$_REQUEST['cid']."'";
$query3 = "delete from cookie_tag where cid='".$_REQUEST['cid']."'";

begin();

if(mysqli_query($conn,$query3) != true){
    rollback();
    echo "cookie tag is not deleted.";
    echo "<br>";
    echo "Error: ".mysqli_error($conn);
    exit();
}
if(mysqli_query($conn,$query2) != true){
    rollback();
    echo "cookie msg is not deleted.";
    echo "<br>";
    echo "Error: ".mysqli_error($conn);
    exit();
}
if(mysqli_query($conn,$query) != true){
    rollback();
    echo "cookie is not deleted.";
    echo "<br>";
    echo "Error: ".mysqli_error($conn);
    exit();
}

// echo $query;
// echo "<br>";
// echo $query2;
// echo "<br>";
// echo $query3;
// echo "<br>";
// exit();
commit();
header("location: ../cookie_list.php?d=true");

?>