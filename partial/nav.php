<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <symbol id="icon-user-x" viewBox="0 0 24 24">
            <path d="M17 21v-2c0-1.38-0.561-2.632-1.464-3.536s-2.156-1.464-3.536-1.464h-7c-1.38 0-2.632 0.561-3.536 1.464s-1.464 2.156-1.464 3.536v2c0 0.552 0.448 1 1 1s1-0.448 1-1v-2c0-0.829 0.335-1.577 0.879-2.121s1.292-0.879 2.121-0.879h7c0.829 0 1.577 0.335 2.121 0.879s0.879 1.292 0.879 2.121v2c0 0.552 0.448 1 1 1s1-0.448 1-1zM13.5 7c0-1.38-0.561-2.632-1.464-3.536s-2.156-1.464-3.536-1.464-2.632 0.561-3.536 1.464-1.464 2.156-1.464 3.536 0.561 2.632 1.464 3.536 2.156 1.464 3.536 1.464 2.632-0.561 3.536-1.464 1.464-2.156 1.464-3.536zM11.5 7c0 0.829-0.335 1.577-0.879 2.121s-1.292 0.879-2.121 0.879-1.577-0.335-2.121-0.879-0.879-1.292-0.879-2.121 0.335-1.577 0.879-2.121 1.292-0.879 2.121-0.879 1.577 0.335 2.121 0.879 0.879 1.292 0.879 2.121zM22.293 7.293l-1.793 1.793-1.793-1.793c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414l1.793 1.793-1.793 1.793c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l1.793-1.793 1.793 1.793c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-1.793-1.793 1.793-1.793c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0z"></path>
        </symbol>
        <symbol id="icon-user-check" viewBox="0 0 24 24">
            <path d="M17 21v-2c0-1.38-0.561-2.632-1.464-3.536s-2.156-1.464-3.536-1.464h-7c-1.38 0-2.632 0.561-3.536 1.464s-1.464 2.156-1.464 3.536v2c0 0.552 0.448 1 1 1s1-0.448 1-1v-2c0-0.829 0.335-1.577 0.879-2.121s1.292-0.879 2.121-0.879h7c0.829 0 1.577 0.335 2.121 0.879s0.879 1.292 0.879 2.121v2c0 0.552 0.448 1 1 1s1-0.448 1-1zM13.5 7c0-1.38-0.561-2.632-1.464-3.536s-2.156-1.464-3.536-1.464-2.632 0.561-3.536 1.464-1.464 2.156-1.464 3.536 0.561 2.632 1.464 3.536 2.156 1.464 3.536 1.464 2.632-0.561 3.536-1.464 1.464-2.156 1.464-3.536zM11.5 7c0 0.829-0.335 1.577-0.879 2.121s-1.292 0.879-2.121 0.879-1.577-0.335-2.121-0.879-0.879-1.292-0.879-2.121 0.335-1.577 0.879-2.121 1.292-0.879 2.121-0.879 1.577 0.335 2.121 0.879 0.879 1.292 0.879 2.121zM16.293 11.707l2 2c0.391 0.391 1.024 0.391 1.414 0l4-4c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-3.293 3.293-1.293-1.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path>
        </symbol>
        <symbol id="icon-rewind" viewBox="0 0 24 24">
            <path d="M15.343 16l5.657 5.657-2.828 2.828-8.486-8.485 8.485-8.485 2.829 2.828-5.657 5.657z"></path>
        </symbol>
    </defs>
</svg>

<nav class="navbar navbar-expand-md navbar-light bg-light foo sticky-top">

    <div class="container-fluid">

        <button class="navbar-toggler btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-left: 0 !important;">
            <span class="navbar-toggler-icon" style="font-size:15px;"></span>
        </button>

        <a class="mx-2 text-danger fs-2" href="index.php" style="line-height: 30px !important;"> C<small>o<img src="./pics/logo.png" alt="" width="30" height="24">kie</small>J<small>ar</small></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" id="home" aria-current="page" href="index.php">Home</a>
                </li>
                <?php
                if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                    echo '
                    <li class="nav-item ">
                        <a class="nav-link" id="insert_cookie" href="insert_cookie.php">Insert Cookie</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" id="cookie_list" href="cookie_list.php">Cookies List</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" id="eat_cookie" href="eat_cookie.php">Eat Cookies</a>
                    </li>
                    ';
                }
                ?>

                <li class="nav-item ">
                    <a class="nav-link" id="contact_us" href="contactus.php">Contact Us</a>
                </li>
            </ul>

            <ul class="nav d-flex">

                <?php
                if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {

                    echo '<li class="nav-item">
                    <ul class="nav">
                        <li class="mx-3"><a href="./profile.php" class="btn btn-outline-danger btn-sm">Profile</a></li>
                        <li><a href="./partial/logout.php" class="btn btn-outline-danger btn-sm">Log Out</a></li>
                    </ul>
                </li>';
                    //     echo '<li class="nav-item dropdown">
                    //     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    //         data-bs-toggle="dropdown" aria-expanded="false"> <svg class="icon icon-user-x">
                    //             <use xlink:href="#icon-user-check"></use>
                    //         </svg>
                    //     </a>

                    //     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    //         <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                    //         <li><hr class="dropdown-divider"></li>
                    //         <li><a class="dropdown-item" href="./partial/logout.php">Log Out</a></li>
                    //     </ul>
                    // </li>';
                } else {
                    echo '<li class="nav-item dropdown">
                        <a class="nav-link btn " href="#" id="navbarDropdown" data-bs-toggle="modal" data-bs-target="#singin-modal">
                            <svg class="icon icon-user-x">
                                <use xlink:href="#icon-user-x"></use>
                            </svg>
                        </a>
                    </li>';
                    echo '<div class="modal fade" id="singin-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="singin-modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="singin-modalTitle">Sign In</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">  
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info fade show" role="alert">
                                If you don\'t have account, please click &gt; <strong> <a href="signup.php" class="text-secondary"> Sign Up </a></strong>
                            </div>
                            <form autocomplete="off" method="POST" id="login" action="index.php">
                                <div class="form-group">
                                    <input type="text" class="form-control mt-2" name="username" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" title="Enter valid email id" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email id" value="jbzala004@gmail.com" required>
            
                                    <input type="password" class="form-control mt-2" name="password" id="exampleInputPassword1" placeholder="Password" value="Aa!11" required>
            
                                    <input type="checkbox" class="form-check-input mt-2" id="exampleCheck1" name="keepLogedin">
                                    <label class="form-check-label mt-2" for="exampleCheck1">Keep me Signned In</label>
                                </div>
                            </form>
            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="login">
                                Sign In
                            </button>
                        </div>
                    </div>
                </div>
            </div>';
                }
                ?>

            </ul>
        </div>

    </div>

</nav>