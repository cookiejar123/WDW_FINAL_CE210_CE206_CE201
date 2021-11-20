<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

</head>

<body>

    <?php

    require('connection.php');

    require('error_msg.php');


    @$name = $_POST['name'];
    @$email = trim($_POST['email']);
    @$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    if (isset($name) &&  isset($email) && isset($password)) {
        $query =  "INSERT INTO `user` (`uid`, `name`, `email`, `password`) VALUES ( NULL,'$name',  '$email', '$password')";

        $result = mysqli_query($conn, $query);
        if ($result) {
            success_msg("Your account is created successfully", "../index.php", "Home");
        } else {
            failure_msg("Something is wrong, Pleare re-create your account", "../signup.php", "Sign Up");
        }
    } else {
        failure_msg("Something is wrong, Pleare re-create your account. (var is not set)", "../signup.php", "Sign Up");
    }
    ?>



</body>

</html>