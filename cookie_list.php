<?php
require('./partial/connection.php');

session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cookies</title>
    <?php
    require('./partial/link.php');
    require('./tools/dt/style.php');
    ?>
    <style>
        .alert-popup {
            position: absolute;
            width: auto;
            z-index: 99999;
            opacity: 0.8;
            left: 50%;
            transform: translate(-50%, -50%);
            /* display: none !important; */
        }
    </style>
</head>

<body>
    <?php
    require('./partial/nav.php');
    ?>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>

    <div class="alert alert-success d-flex align-items-center d-none alert-popup" id="alert-tag-success" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" /></svg>
        <div id="success_msg">

        </div>
    </div>

    <div class="m-3">

        <?php
        $query = "SELECT cid,title,edit_date,is_public,likes FROM `cookie`";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <= 0) {
            echo '<p class="display-4 text-primary text-center mt-5" >Cookie jar is empty.</p>
                    <h3 class="text-center mt-5"><a href="./insert_cookie.php" class="text-warning" >  click here to add new cookie </a></h3>';
            exit();
        } else {

        ?>
            <table class="table table-hover" id="mytable">
                <thead>
                    <tr>
                        <th>Cookie Name</th>
                        <th>IsPublic / Likes</th>
                        <th>Last update on</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    if ($row['is_public'] == 1) {
                        $public = "Yes";
                    } else {
                        $public = "No";
                    }
                    echo "<td>" . $public . " / " . $row['likes'] . " </td>";
                    echo "<td>" . $row['edit_date'] . "</td>";
                    echo "<td><a type='button' href='./update_cookie.php?update=" . $row['cid'] . "' class='btn btn-outline-primary edit'>Edit</a></td>";
                    echo "<td><a type='button' onclick='deleteConfirmation(" . $row['cid'] . ")' class='btn btn-outline-danger edit'>Delete</a></td>";

                    echo "</tr>";
                }

                ?>
            </table>
        <?php
        }

        ?>

    </div>

</body>

</html>
<?php
require('./partial/script.php');
require('./tools/dt/script.php');

?>
<script>
    // active link highlight 
    let link = document.getElementById('cookie_list');
    link.classList.add('active');

    $(document).ready(function() {
        $('#mytable').DataTable({
            "dom": ' <"#length"l><"#search"f>rt<"info"i><"page"p>',
            "stateSave": true
        });
    });

    function deleteConfirmation(cid) {
        let ask = window.confirm("Are you sure you want to delete this cookie?");
        if (ask) {
            window.location.href = "./partial/cookie_delete.php?cid=" + cid;
        }
    }


    //alert lines
    <?php
    if(($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['update']) && $_GET['update'] == true)){

    ?>


    var myAlert = document.getElementById("alert-tag-success");
    success_msg.innerText = "Cookie updated successfully.";
    var bsAlert = new bootstrap.Alert(myAlert);
    myAlert.classList.remove('d-none');
    setTimeout(() => {
        myAlert.classList.add('d-none');
        // bsAlert.close();
    }, 5000);

    <?php
    }

    ?>
</script>