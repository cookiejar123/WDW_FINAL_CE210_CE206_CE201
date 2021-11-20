<?php
require('connection.php');
session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    exit();
}

$request= json_decode(file_get_contents('php://input'),true);

if(isset($request['name']) && isset($_SESSION['userid'])){

    $query = "INSERT INTO `tags` (`tid`, `uid`, `name`) VALUES (NULL, '".$_SESSION['userid']."', '".$request['name']."');" ;
    
    $result = mysqli_query($conn,$query);


     if($result == true)
     {
        echo json_encode(true);
     }
     else{
        // echo json_encode(false);
        echo json_encode(false);
     }

 }
?>