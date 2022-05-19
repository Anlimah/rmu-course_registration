<?php
session_start();
if (!isset($_SESSION["_step1Token"])) {
    $rstrong = true;
    $_SESSION["_step1Token"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>

</head>

<body>
    <img src="../images/RMU-LOG.png" alt="RMU LOG">
    <h1>Step 1</h1>
    <form action="#" id="step1Form" method="post" enctype="multipart/form-data">
        <div>
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" placeholder="Type your first name">
        </div>
        <div>
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="Male" selected>Male</option>
                <option value="Female">Male</option>
            </select>
        </div>
        <div>
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob">
        </div>
        <div>
            <label for="phone_num">Country</label>
            <select name="country" id="country">
                <option value="Cameroun">Cameroun</option>
                <option value="Gambia">Gambia</option>
                <option value="Ghana" selected>Ghana</option>
                <option value="Serria Leone">Serria Leone</option>
                <option value="Liberia">Liberia</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <button type="continue">Continue</button>
        <input type="hidden" name="_vToken" value="<?php echo $_SESSION["_step1Token"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                //window.location.href = "purchase_step2.php";
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep1",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        res = JSON.parse(result);
                        console.log(res);
                        if (res["response"] == "success") {
                            console.log(res['msg']);
                            window.location.href = 'verify-code.php'
                        } else {
                            console.log(res['msg']);
                        }
                    },
                    error: function(error) {}
                });
            });
        });
    </script>
</body>

</html>