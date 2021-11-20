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



if (isset($_POST['c_title']) && $_POST['c_title'] != "" && isset($_POST['cid'])) {
    begin();
    //tbl cookie
    $uid = $_SESSION['userid'];
    $title = $_POST['c_title'];
    $cid = $_POST['cid'];
    $isPublic = 0;
    $timestamp = date_timestamp_get(date_create());
    if (isset($_POST['c_isPublic'])) {
        $isPublic = 1;
    }

    $query = "update cookie set title ='" . $title . "',edit_date = now(), is_public = '" . $isPublic . "' where cid = '" . $cid . "' and uid = '" . $uid . "';";

    if (!mysqli_query($conn, $query)) {
        echo "Error (in cookie update): " . mysqli_error($conn);
        rollback();
        exit();
    }


    if (isset($_POST['c_isMsg'])  && isset($_POST['c_msg'])) {
        $query = "update cookie_msg set msg = '" . $_POST['c_msg'] . "' where cid = '" . $cid . "'";
        $result = mysqli_query($conn, $query);
        $rowsaffected = mysqli_affected_rows($conn);

        if ($result == true && $rowsaffected === 0) {
            $query = "INSERT INTO `cookie_msg` (`cid`, `msg`) VALUES ('" . $cid . "', '" . $_POST['c_msg'] . "')";

            if (!mysqli_query($conn, $query)) {
                echo "Error (in cookie_msg update): " . mysqli_error($conn);
                rollback();
                exit();
            }
        }
    } else {
        //delete that msg 
        $query = "delete from cookie_msg where cid = '" . $cid . "'";
        if (!mysqli_query($conn, $query)) {
            echo "Error (in cookie_msg delete): " . mysqli_error($conn);
            rollback();
            exit();
        }
    }

    if (isset($_POST['c_tags'])) {
        // print_r($tags);
        $query1 =  "delete from cookie_tag where cid = '" . $cid . "'";
        if (!mysqli_query($conn, $query1)) {
            echo "Error (in cookie_tag delete for updation): " . mysqli_error($conn);
            rollback();
            exit();
        }
        foreach ($_POST['c_tags'] as $tid) {
            $query = "INSERT INTO `cookie_tag` (`cid`, `tid`) VALUES ('" . $cid . "', '" . $tid . "');";
            if (!mysqli_query($conn, $query)) {
                echo "Error (in cookie_tag insert): " . mysqli_error($conn);
                rollback();
                exit();
            }
        }
    }

    commit();
    header("location: ../cookie_list.php?update=true");
    exit();
} else {
    echo "not set title err";
}
