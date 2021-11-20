<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php
    require('./partial/link.php');
    ?>
</head>

<body>
    <?php
    session_start();
    require('./partial/nav.php');
    ?>

    <main class="container mt-3 col-xl-6">
        <form class="mx-auto" action="./partial/signup_insert.php" method="POST" autocomplete="off">
            <div class="accordion container" id="accordionExample">

                <!-- user name -->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <label for="InputEmail" class="form-label font-weight-bold">User Name</label>
                        <input type="text" autocomplete="off" pattern="[a-zA-Z0-9_ ]{2,25}" title="You can use only a to z, A to Z, 0 to 9, _(underscore) and space" onkeyup="nameValidation()" class="form-control" name="name" id="name" aria-describedby="emailHelp" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" required>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="card-body">
                            Why? - Used to display to you and others.
                        </div>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="card">
                    <div class="card-header" id="headingFive">

                        <label for="InputEmail" class="form-label font-weight-bold">Email address</label>
                        <input type="email" class="form-control" onkeyup="emailValidation()" name="email" id="email" aria-describedby="emailHelp" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" required>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="card-body">
                            Why? - We will provide usefull information on this email id and also It will be used for login purpose. so, dont forget it..
                        </div>
                    </div>
                </div>
                <!-- Password -->
                <div class="card">
                    <div class="card-header" id="headingSix">

                        <label for="InputPassword" class="form-label font-weight-bold">Password</label>
                        <input type="password" onkeyup="chk_passwd()" minlength="5" maxlength="15" class="form-control" name="password" id="password" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" required>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="card-body">
                            Why? - It will required to login.
                        </div>
                    </div>
                </div>
                <!-- Re enter Password -->
                <div class="card">
                    <div class="card-header" id="headingSeven">

                        <label for="InputPassword" class="form-label font-weight-bold">Re-enter above Password</label>
                        <input type="password" onkeyup="chk_passwd()" class="form-control" name="re-password" id="rePassword" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" required>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                        <div class="card-body">
                            Why? - Check weather you set your desired password or you may enterd something unwanted.
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-danger my-2" id="submit">Submit</button>
            </div>
        </form>
    </main>

    <?php
    require('./partial/script.php');
    ?>
    <script>
        // email validation ***** starts *****
        let email = document.getElementById('email');
        const emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let emailVal = email.value;
        let dbData;

        async function phpFetchNames() {
            let name = document.getElementById('email');
            // console.log('email: '+name.value);
            let postData = {
                method: 'post',
                headers: {
                    accept: 'application/text',
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    "name": name.value
                })
            }

            let response = await fetch('./partial/signup_uname_check.php', postData);

            let fdata = await response.text();

            if (response.ok) {
                return fdata;
            } else {
                console.log('error');
            }
        }

        function emailValidation() {
            phpFetchNames().then((data) => {
                dbData = data;
                emailVal = email.value;
                if (!emailRegEx.test(emailVal) || (dbData == "true")) {
                    email.classList.add('is-invalid');
                } else {
                    email.classList.remove('is-invalid');
                }
            });
        }
        phpFetchNames().then((data) => {
            dbData = data;
        });
        // email validation ***** ends *****


        //  password validation ***** starts *****
        let password = document.getElementById('password');
        let rePassword = document.getElementById('rePassword');
        const passwordRegEx = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{5,15}$/; //with at least a symbol, upper and lower case letters and a number (5,15) characters long
        let passwordVal = password.value;

        function passwordValidation() {
            passwordVal = password.value;
            if (!passwordRegEx.test(passwordVal)) {
                password.classList.add('is-invalid');
            } else {
                password.classList.remove('is-invalid');
            }
        }

        function chk_passwd() {
            passwordValidation()
            if (password.value != rePassword.value) {
                rePassword.classList.add('is-invalid');
            } else {
                rePassword.classList.remove('is-invalid');
            }
        }
        //  password validation ***** ends *****

        //  name validation ***** Starts *****
        let name = document.getElementById('name');
        const nameRegEx = /[a-zA-Z0-9_ ]{2,25}/;
        let nameVal = name.value;

        function nameValidation() {
            nameVal = name.value;
            if (!nameRegEx.test(nameVal)) {
                name.classList.add('is-invalid');
            } else {
                name.classList.remove('is-invalid');
            }
        }
        //  name validation ***** ends *****


        //submit button **** Starts ****
        let submit = document.getElementById('submit');
        submit.addEventListener('click', (e) => {

            nameValidation()
            emailValidation()
            chk_passwd()

            if (email.classList.contains('is-invalid')) {
                e.preventDefault();
                alert("Email: " + email.value + " is already exist, please write unique email id.");
            }
            if (rePassword.classList.contains('is-invalid')) {
                e.preventDefault();
                alert("Your re-entered password is does not matches.");
            }
            if (name.classList.contains('is-invalid') || email.classList.contains('is-invalid') || password.classList.contains('is-invalid')) {
                e.preventDefault();
                alert("Please enter valid data.");
            }

        });
        //submit button **** Ends ****
    </script>
</body>

</html>