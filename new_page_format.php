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
    <title>Document</title>
    <?php
    require('./partial/link.php');
    ?>
</head>

<body>
    <?php
    require('./partial/nav.php');
    ?>

</body>

</html>
<?php
require('./partial/script.php');
?>
<script>
    // active link highlight 
    let link = document.getElementById('page_name');
    link.classList.add('active');
</script>