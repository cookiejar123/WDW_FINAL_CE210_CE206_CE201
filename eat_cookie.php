<?php
require('./partial/connection.php');

session_start();

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
    exit();
}

$query = "select * from cookie where uid=" . $_SESSION['userid'] . " or is_public=1  order by rand() limit 1";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['tags'])) {
    // $tagArr = explode(",",$_GET['tags']);
    $query = "select * from cookie where cid in (SELECT cid FROM `cookie_tag` where tid in (" . $_GET['tags'] . ") GROUP by cid order by count(cid) desc) order by rand()";
}

// $query = "select title,cid,edit_date from cookie where is_public=1 order by rand() limit 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    // header("location: cookie_list.php");
    exit();
}
$data = mysqli_fetch_assoc($result);
$title =  $data['title'];
$cid = $data['cid'];
$date = $data['edit_date'];
$uid = $data['uid'];


$query = "select msg from cookie_msg where cid= " . $cid . "";
$result = mysqli_query($conn, $query);
$msg = "<p class='fw-light fs-6'>No description provided.</p>";
if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $msg =  $data['msg'];
}

$query = "select name from tags where tid in (select tid from cookie_tag where cid = " . $cid . ")";
$result = mysqli_query($conn, $query);
$tags = "";
if (mysqli_num_rows($result) <= 0) {
    $tags = "No tags";
} else {
    while ($data = mysqli_fetch_assoc($result)) {
        $tags = $tags . ", " . $data['name'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require('./partial/link.php');
    ?>
    <style>
        #cookie {
            max-width: 500px;
            max-height: 400px;
        }
    </style>
</head>

<body>
    <?php
    require('./partial/nav.php');
    ?>

    <div class="container">

        <div class="card text-center mx-auto my-5" id="cookie">
            <h5 class="card-header">
                <?php echo $title; ?>
            </h5>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p><?php echo $msg; ?></p>
                    <footer class="fw-lighter fs-6 text-end"> - <cite title="Source Title"><?php echo trim($tags, ","); ?></cite>
                    </footer>
                </blockquote>
                <?php
                if ($uid != $_SESSION['userid']) {
                    echo "<p class='fw-light fs-6 text-center badge bg-secondary rounded-pill'>Public cookie</p>";
                }
                ?>
            </div>
            <div class="card-footer fw-light fs-6 ">
                <?php
                $date = date_create($date);
                echo date_format($date, "d M Y, g:i:s A");
                ?>

            </div>
        </div>
        <?php
        if ($uid == $_SESSION['userid']) {
        ?>
            <a type='button' href='./update_cookie.php?update= <?php echo $cid; ?>' class='btn btn-outline-primary edit'>Edit</a>
        <?php
        }
        ?>
        <button class="btn btn-outline-info" id="onemore">Give me one more cookie</button>
        <!-- <button class="btn btn-outline-warning" onclick="changeCardColor()">change cookie color</button> -->
        

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="enPrivate" onclick="getUtags()" name="enPrivate" data-bs-toggle="collapse" data-bs-target="#collapseMsg" aria-expanded="false" aria-controls="collapseMsg">
            <label class="form-check-label" for="enPrivate">Cookies from my jar</label>
        </div>
        <div class="form-floating mb-3 collapse" id="collapseMsg">
            <div class="list-group">

                <?php

                $query = "select tid,name from tags where uid = " . $_SESSION['userid'] . "";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) <= 0) {
                    echo "please create tags";
                } else {
                    while ($data = mysqli_fetch_assoc($result)) {

                        echo '<label class="list-group-item">
                                    <input class="form-check-input me-1 utags" type="checkbox" value="" id=' . $data['tid'] . '>
                                    ' . $data['name'] . '
                              </label>';
                    }
                }

                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php
require('./partial/script.php');
?>
<script>
    // active link highlight 
    let link = document.getElementById('eat_cookie');
    link.classList.add('active');

    let enPrivate = document.getElementById('enPrivate');
    let onemore = document.getElementById('onemore');
    onemore.addEventListener('click', () => {
        if (enPrivate.checked) {
            window.location.href = "./eat_cookie.php?tags=" + getUtags();
        } else {
            window.location.reload();
        }
    });

    let utags = document.querySelectorAll(".utags");

    function getUtags() {
        let tagid = [];
        utags.forEach(element => {
            if (element.checked)
                tagid.push(element.id);
        });
        console.log(tagid);
        return tagid.toString();
    }

    let card = document.querySelector('.card');
    let allText = ['text-white','text-white','text-white','text-white','text-dark','text-dark','text-dark','text-white'];
    let allBg = ['bg-primary','bg-secondary','bg-success','bg-danger','bg-warning','bg-info','bg-light','bg-dark'];
    let allBd = ['border-primary','border-secondary','border-success','border-danger','border-warning','border-info','border-light','border-dark'];

    function changeCardColor(){
        let index = Math.floor(allText.length*Math.random());
        card.classList.remove(...allBg,...allText)
        card.classList.add(allBg[index])
        card.classList.add(allText[index])
    }
    changeCardColor();

</script>