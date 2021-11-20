<?php

require('connection.php');
session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
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



if(isset($_POST['c_title']) && $_POST['c_title']!=""){
    begin();
    //tbl cookie
    $uid = $_SESSION['userid'];
    $title = mysqli_real_escape_string($conn,$_POST['c_title']);
    $isPublic = 0;
    $timestamp = date_timestamp_get(date_create());
    if(isset($_POST['c_isPublic'])){
        $isPublic = 1;
    }

    $query = "INSERT INTO `cookie` (`cid`, `uid`, `title`, `edit_date`, `is_public`, `likes`) VALUES (NULL, '".$uid."', '".$title."', now(), '".$isPublic."', '0');";

    
    if(!mysqli_query($conn,$query)){
        echo "Error (in cookie insert): ".mysqli_error($conn);
        rollback();
        exit();
    }
    $cid = mysqli_insert_id($conn);

    
    if(isset($_POST['c_isMsg'])  && isset($_POST['c_msg'])){
        $cmsg = mysqli_real_escape_string($conn,$_POST['c_msg']);
        $query = "INSERT INTO `cookie_msg` (`cid`, `msg`) VALUES ('".$cid."', '".$cmsg."')";
        if(!mysqli_query($conn,$query)){
            echo "Error (in cookie_msg insert): ".mysqli_error($conn);
            echo "<br>";
            echo $query;
            echo "<br>";
            echo $cmsg;
            rollback();
            exit();
        }
    }
    if(isset($_POST['c_tags'])){
        // print_r($tags);
        foreach($_POST['c_tags'] as $tid)
        {
            // echo $tid." ";
            $query = "INSERT INTO `cookie_tag` (`cid`, `tid`) VALUES ('".$cid."', '".$tid."');";

            if(!mysqli_query($conn,$query)){
                echo "Error (in cookie_tag insert): ".mysqli_error($conn);
                rollback();
                exit();
            }
        }
        
    }

    commit();
    echo "Cookie successfully inserted.";
    header("location: ../insert_cookie.php?inserted=true");
    exit();
}else{
    echo "not set title err";
}
?>