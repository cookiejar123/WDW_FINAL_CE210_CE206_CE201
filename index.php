<?php

$LogedinAlert;

session_start();
// $_SESSION['logedin'] = "lol";



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $_SESSION['logedin'] = false;
    $LogedinAlert = false;

    require('./partial/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($username) && isset($password)) {

        $query = "select `uid`,`password` from `user` where `email` = '$username' limit 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) != 0) {

            $passwordhash;
            $uid;
            foreach ($result as $foo) {
                $passwordhash = $foo['password'];
                $uid = $foo['uid'];
            }
            if (password_verify($password, $passwordhash)) {

                $LogedinAlert = true;

                $_SESSION['logedin'] = true;
                $_SESSION['userid'] = $uid;
                if (isset($_POST['keepLogedin'])) {
                    setcookie("username", $username, 86400 * 30 + time(), '/');
                    // setcookie("password", $password, 86400 * 120 + time());
                    setcookie("password", $passwordhash, 86400 * 30 + time(), '/');
                }
            }
        }
    }
    // } elseif ( isset($_SESSION['logedin']) && $_SESSION['logedin'] == false &&  isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
} elseif (count($_SESSION) == 0 &&  isset($_COOKIE['username']) && isset($_COOKIE['password'])) {

    $_SESSION['logedin'] = false;

    require('./partial/connection.php');

    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    if (isset($username) && isset($password)) {
        $query = "select `uid`,`password` from `user` where `email` = '$username' limit 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) != 0) {
            $passwordhash;
            $uid;
            foreach ($result as $foo) {
                $passwordhash = $foo['password'];
                $uid = $foo['uid'];
            }

            // if (password_verify($password, $passwordhash)) {
            if ($password == $passwordhash) {

                $LogedinAlert = true;
                $_SESSION['logedin'] = true;
                $_SESSION['userid'] = $uid;
            }
        }
    }
}


?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <?php
    require('./partial/link.php');
    ?>

    <title>Cookie Jar</title>

    <style>
        .carousel-inner>.carousel-item>img {
            min-height: 60vh;
            max-height: 60vh;
            width: 100%;
            object-fit: cover;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Verdana, sans-serif;
        }

        .mySlides {
            display: none;
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
        }

        #features ul {
            margin: -143px 0;
        }

        #features ul li {
            width: 300px;
            padding-top: 140px;
            float: left;
            margin: 87px;
            text-align: center;
        }

        #features ul li.feature-1 {
            background: url('../images/features-icon-1.png') no-repeat top center;
        }

        #features ul li.feature-2 {
            background: url('../images/features-icon-2.png') no-repeat top center;
        }

        #features ul li.feature-3 {
            background: url('../images/features-icon-3.png') no-repeat top center;
        }

        #primary-content {
            background-color: #f8fafa;
            text-align: center;
            margin: 58px;
        }

        #primary-content h3 {
            display: block;
            margin: 0 auto 20px auto;
            width: 400px;
            border-bottom: 1px solid #02b8dd;

        }

        #primary-content a img {
            margin: 20px 0;
            width: 1205px;
            height: 324px;
        }

        #secondary-content {
            padding: 60px 0;
            text-align: center;
        }

        #secondary-content article {
            width: 479px;
            height: 725px;
            float: left;
            background-color: #f5f5f5;
        }

        #secondary-content article:first-child {
            margin-right: 20px;
        }

        #secondary-content article .overlay {
            height: 270px;
            width: 244px;
            padding: 20px;
            margin: 10px;
        }

        article h4 {
            padding-bottom: 20px;
        }

        .more-link {
            border: 1px solid #02b8dd;
            color: #02b8dd;
            padding: 6px 20px;
            border-radius: 3px;
        }

        .more-link:hover {
            background-color: #02b8dd;
            color: #fff;
        }

        #cta {
            padding: 60px 0;
            text-align: center;
        }

        #cta h3 {
            display: block;
            margin: 0 auto 20px auto;
            width: 400px;
            border-bottom: 1px solid #02b8dd;
            padding: 0 0 20px 0;
        }
    </style>

</head>

<body>

    <?php
    require('./partial/nav.php');

    if (isset($LogedinAlert)) {
        if ($LogedinAlert == true) {
            echo ' <div class="alert alert-success shadow a-msg" role="alert" id="logedin-alert">
           <b>' . $username . '</b>, You have successfully loged in.
    </div>';
        } else {
            echo '<div class="alert alert-danger shadow a-msg" role="alert" id="logedin-alert">
        Sorry! Invalid credential, Please try again to Log in.
    </div>';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['logout']) && $_GET['logout'] == true) {
        echo ' <div class="alert alert-success shadow a-msg" role="alert" id="logedin-alert">
           You have successfully <b> loged out </b>.
    </div>';
    }


    ?>



    <?php
    require('./partial/carousel.php');
    ?>

    <div id="features">

        <ul>
            <li class="feature-1">
                <h4>Push Yourself</h4>
                <p>Your mind has the potential to convince you to not put the effort. Your body has the ability to accomplish the goal but your mind acts like the devil who does not want you to try. If you can ignore the pessimistic voice within you which asks you to give up, you can push yourself to victory.</p>
            </li>
            <li class="feature-2">
                <h4>Create a cookie jar</h4>
                <p>To start, write down 10 setbacks you have overcome. They do not have to be major challenges. You can list down simpler victories like:<br>
                    -Scoring good marks in a tough exam<br>
                    -The extra 15 minutes you worked out one day when you were exhausted<br>
                    -Completing a task which no one thought you could</p>
            </li>
            <li class="feature-3">
                <h4>Use your cookies</h4>
                <p>Whenever you face any hardship, recall your cookies. Think about the effort you put in to overcome a prior challenge. Remember how difficult or painful it was to go through the obstacle. Realize the fact that you could have given up, but the champion within you kept going and came out victorious.</p>
            </li>
            <div class="clear"></div>
        </ul>

        <div id="primary-content">
            <div class="wrapper">
                <article>
                    <h3>Featured Cookie Jar</h3>
                    <p>The cookie jar method is a technique of using your past achievements to motivate yourself when you are struggling. You make a list of all your victories and triumphs along with obstacles and challenges you overcame. Together they serve as an imaginary jar to remind and motivate yourself of what you have achieved in life. </p>
                </article>
            </div>
        </div>
    </div>
    <div id="secondary-content">
        <div class="wrapper">
            <article style="background-image: url('./pics/home/image11.jpeg'); margin: 10px; ">
                <div class="overlay">
                    <h1 style="color: white;">HARD TIME</h1>
                    <hr size="1px" width="420px" color="white">
                    <p class="text-warning"><small>If you are living, it means you will have to face some hard problems. Life is just no straight forward. Our body and mind both needs problems to sustain. So its part of life. Just enjoy it.
                        </small></p>

                </div>
            </article>
            <article style="background-image: url('./pics/home/image12.jpeg'); margin: 10px; ">
                <div class="overlay">
                    <h1 class="text-dark">I'm stronger</h1>
                    <hr size="1px" width="420px" color="white">
                    <p class="text-light"><small>Don't be afraid by thinking future problems. Your are strong enough to handle that situation. If something breaks down at that hard time, that would be your weaknesses.
                        </small></p>

                </div>
            </article>
            <article style="background-image: url('./pics/home/image13.jpeg'); margin: 10px; ">
                <div class="overlay">
                    <h1 style="color: white;">Be Always Happy</h1>
                    <hr size="1px" width="420px" color="white">
                    <p><small>Why are you sad. You have great body, sweet and supportive family. what else you needed to achieve your goals. Go ahead and enjoy your journey.</small></p>

                </div>
            </article>
            <div class="clear"></div>
        </div>
    </div>
    <div id="cta">
        <div class="wrapper">
            <h3>Heard Enough?</h3>
            <p class="">The cookie jar is a place in my mind where I put all things bad and good that shaped me. Some people try to forget the bad in their life. I use my bad for strength when needed, great lessons learned. In that cookie jar, I pull out whatever I need for the task at hand.</p>
            <a href="signup.php" class="btn btn-outline-info">Get Started</a>
        </div>
    </div>

</body>
<?php
require('./partial/script.php');
// require('./partial/cart_script.php');
?>
<script>
    // active link highlight 
    let link = document.getElementById('home');
    link.classList.add('active');

    function destroyalert() {
        setTimeout(() => {
            var myAlert = document.getElementById("logedin-alert");
            var bsAlert = new bootstrap.Alert(myAlert);
            bsAlert.close();
        }, 5000);
    }

    <?php

    if ((isset($LogedinAlert)) || (($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['logout']) && $_GET['logout'] == true))) {
        echo "destroyalert()";
    }

    ?>

    var myCarousel = document.querySelector('#Gcarousel')
    var carousel = new bootstrap.Carousel(myCarousel)
</script>



</html>