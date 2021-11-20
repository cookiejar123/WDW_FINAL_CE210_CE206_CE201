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
    <title>Insert Cookie</title>
    <?php
    require('./partial/link.php');
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

        #c_tags {
            max-height: 250px;
            overflow-y: scroll;
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
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div class="alert alert-success d-flex align-items-center d-none alert-popup" id="alert-tag-success" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" /></svg>
        <div id="success_msg">

        </div>
    </div>
    <div class="alert alert-danger d-flex align-items-center d-none alert-popup" id="alert-tag-fail" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" /></svg>
        <div id="danger_msg">

        </div>
    </div>

    <div class="container mt-3">
        <div class="card mb-3">
            <h5 class="card-header">Insert Update Delete Tags</h5>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter new tag name" id="insert_tag_txt">
                    <button class="btn btn-outline-secondary" type="button" id="insert_tag_btn">Insert Tag</button>
                </div>
                <select class="form-select mb-3" id="ud_tag_dd">

                </select>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Edit tag name" id="ud_tag_txt">
                    <button class="btn btn-outline-secondary" type="button" id="update_tag_btn">Update Tag</button>
                    <button class="btn btn-outline-secondary" type="button" id="delete_tag_btn">Delete Tag</button>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Insert Cookie</h5>
            <div class="card-body">
                <form action="./partial/insert_cookie.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="c_title" name="c_title" placeholder="Its easy, i can do it." required>
                        <label for="floatingInput">Enter Cookie Title</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="c_isPublic" name="c_isPublic">
                        <label class="form-check-label" for="c_isPublic">Check if you want to make it public.</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" onclick="enableMsg(this)" id="c_isMsg" name="c_isMsg" data-bs-toggle="collapse" data-bs-target="#collapseMsg" aria-expanded="false" aria-controls="collapseMsg">
                        <label class="form-check-label" for="c_isMsg">Check if you want to add description for cookie.</label>
                    </div>
                    <div class="form-floating mb-3 collapse" id="collapseMsg">
                        <textarea class="form-control" placeholder="Leave a comment here" id="c_msg" name="c_msg" style="height: 100px" disabled></textarea>
                        <label for="c_msg">Description</label>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <select class="form-select m-2" id="c_tag_dd" style="width: 50%; float:left"></select>
                            <div class="row" id="c_tags">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-danger">Put it into jar</button>
                </form>
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
    let link = document.getElementById('insert_cookie');
    link.classList.add('active');

    let success_msg = document.getElementById('success_msg');
    let danger_msg = document.getElementById('danger_msg');

    let insert_tag_btn = document.getElementById('insert_tag_btn');
    let insert_tag_txt = document.getElementById('insert_tag_txt');
    async function insertTag() {
        let postData = {
            method: 'post',
            headers: {
                accept: 'application/text',
                'content-type': 'application/json'
            },
            body: JSON.stringify({
                "name": insert_tag_txt.value,
                "uid": "<?php echo $_SESSION['userid'] ?>"
            })
        }

        let response = await fetch('./partial/insert_tag.php', postData);

        let fdata = await response.text();

        if (response.ok) {
            return fdata;
        } else {
            console.log('error');
        }
    }

    insert_tag_btn.addEventListener('click', () => {
        insertTag().then((data) => {
            if (data) {
                insert_tag_txt.value = "";
                var myAlert = document.getElementById("alert-tag-success");
                success_msg.innerText = "Tag inserted successfully."
                popTags();
            } else {
                var myAlert = document.getElementById("alert-tag-fail");
                danger_msg.innerText = "Something is wrong, Tag is not inserted. Please try again."
            }
            var bsAlert = new bootstrap.Alert(myAlert);
            myAlert.classList.remove('d-none');
            setTimeout(() => {
                myAlert.classList.add('d-none');
                // bsAlert.close();
            }, 5000);
        });
    });

    // getting tags starts
    async function get_tags() {
        let postData = {
            method: 'post',
            headers: {
                accept: 'application/text',
                'content-type': 'application/json'
            },
            body: JSON.stringify({
                "name": "send"
            })
        }

        let response = await fetch('./partial/get_tags.php', postData);

        let fdata = await response.text();

        if (response.ok) {
            return fdata;
        } else {
            console.log('error');
        }
    }

    let ud_tag_txt = document.getElementById('ud_tag_txt');
    let ud_tag_dd = document.getElementById('ud_tag_dd');
    let c_tag_dd = document.getElementById('c_tag_dd');
    let c_tags = document.getElementById('c_tags');
    ud_tag_dd.addEventListener('change', (e) => {
        let selectedText = ud_tag_dd.options[e.target.selectedIndex].text;
        ud_tag_txt.value = selectedText;
    });
    c_tag_dd.addEventListener('change', (e) => {
        let selectedText = c_tag_dd.options[e.target.selectedIndex].text;
        let addTag = `<div class="alert alert-dark alert-dismissible fade show col-12 new_tag" role="alert">
                            ${selectedText}
                            <input type="hidden" name="c_tags[]" value="${myTrim(e.target.value)}">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        if (checkTags(selectedText))
            c_tags.insertAdjacentHTML(`beforeend`, addTag);

    });

    function checkTags(text) {
        let arr = c_tags.querySelectorAll('.new_tag');
        for (let i of arr) {
            if (text === i.innerText)
                return false;
        }
        return true;
    }



    function popTags() {

        c_tags.innerHTML = "";
        ud_tag_dd.innerHTML = "<option selected disabled>Select Tag to update or delete it</option>";
        c_tag_dd.innerHTML = "<option selected disabled>Give meaningful tag to your cookie</option>";

        get_tags().then((data) => {
            let jdata = JSON.parse(data);
            let foo;
            let isEmpty = true;
            for (foo in jdata) {
                ud_tag_dd.innerHTML += `<option value=tag_${jdata[foo]['tid']} > ${jdata[foo]['name']} </option>`;
                c_tag_dd.innerHTML += `<option value=tag_${jdata[foo]['tid']} > ${jdata[foo]['name']} </option>`;
                isEmpty = false;
            }
            if (isEmpty) {
                ud_tag_dd.innerHTML = "<option selected disabled>There is no tags yet inserted. So please insert it.</option>";
                c_tag_dd.innerHTML = "<option selected disabled>There is no tags yet inserted. So please insert it.</option>";
            }
        })
    }

    popTags();
    // getting tags ends

    //delete tag starts
    async function delete_tag(task) {
        let postData = {
            method: 'post',
            headers: {
                accept: 'application/text',
                'content-type': 'application/json'
            },
            body: JSON.stringify({
                "task": task,
                "uid": "<?php echo $_SESSION['userid'] ?>",
                "tid": myTrim(ud_tag_dd.value),
                "update": ud_tag_txt.value
            })
        }
        // console.log('uid: '+"<?php echo $_SESSION['userid'] ?>");
        // console.log('tid: '+myTrim(ud_tag_dd.value));

        let response = await fetch('./partial/del_upd_tag.php', postData);

        let fdata = await response.text();

        if (response.ok) {
            return fdata;
        } else {
            console.log('error');
        }
    }

    function myTrim(x) {
        return x.replace('tag_', '');
    }

    let delete_tag_btn = document.getElementById('delete_tag_btn');
    delete_tag_btn.addEventListener('click', () => {
        delete_tag("delete").then((data) => {
            if (data) {
                ud_tag_txt.value = "";
                var myAlert = document.getElementById("alert-tag-success");
                success_msg.innerText = "Tag deleted successfully."
                popTags();
            } else {
                var myAlert = document.getElementById("alert-tag-fail");
                danger_msg.innerText = "Something is wrong, Tag is not deleted. Please try again."
            }
            var bsAlert = new bootstrap.Alert(myAlert);
            myAlert.classList.remove('d-none');
            setTimeout(() => {
                myAlert.classList.add('d-none');
                // bsAlert.close();
            }, 5000);
        });
    });
    //delete tag ends

    //update tag starts
    let update_tag_btn = document.getElementById('update_tag_btn');
    update_tag_btn.addEventListener('click', () => {
        delete_tag("update").then((data) => {
            if (data) {
                ud_tag_txt.value = "";
                var myAlert = document.getElementById("alert-tag-success");
                success_msg.innerText = "Tag updated successfully."
                popTags();
            } else {
                var myAlert = document.getElementById("alert-tag-fail");
                danger_msg.innerText = "Something is wrong, Tag is not updated. Please try again."
            }
            var bsAlert = new bootstrap.Alert(myAlert);
            myAlert.classList.remove('d-none');
            setTimeout(() => {
                myAlert.classList.add('d-none');
                // bsAlert.close();
            }, 5000);
        });
    });
    //update tag ends

    let c_msg = document.getElementById('c_msg');

    function enableMsg(chkbox) {
        if (chkbox.checked) {
            c_msg.disabled = false;
        } else {
            c_msg.disabled = true;
        }
    }

    //insert success msg starts
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['inserted']) && $_GET['inserted']=="true") {
        echo 'var myAlert = document.getElementById("alert-tag-success");
        success_msg.innerText = "Cookie is added into jar successfully.";
        var bsAlert = new bootstrap.Alert(myAlert);
            myAlert.classList.remove("d-none");
            setTimeout(() => {
                myAlert.classList.add("d-none");
            }, 5000);
        ';
    }
    ?>
    //insert success msg ends
</script>