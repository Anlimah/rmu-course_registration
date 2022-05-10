<?php
session_start();
if (!isset($_SESSION["_applicantToken"])) {
    $rstrong = true;
    $_SESSION["_applicantToken"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
}

require_once('classes/users_handler.php');
$user = new UsersHandler();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <h1>Purchases</h1>
    <form action="#" id="codePurchaseForm" method="post" enctype="multipart/form-data">
        <div>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" placeholder="Type your first name">
        </div>
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" placeholder="Type your last name">
        </div>
        <div>
            <label for="phone_num">Phone Number</label>
            <input type="phone" name="phone_num" id="phone_num" placeholder="Type your phone number">
        </div>
        <div>
            <label for="email_addr">Email Address</label>
            <input type="email" name="email_addr" id="email_addr" placeholder="Type your email address">
        </div>
        <div>
            <label for="">How do you want to be verified?</label>
            <div>
                <input type="radio" name="h_verify" id="v_phone" value="phone" id="phone">
                <label for="phone">SMS</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="h_verify" id="v_email" value="email" id="email">
                <label for="email">Email</label>
            </div>
        </div>
        <button type="submit">Submit</button>
        <input type="hidden" name="_vToken" value="<?php echo $_SESSION["_applicantToken"]; ?>">
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#codePurchaseForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "api/verifyApplicant",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result["response"] == "success") {
                            console.log(result['msg']);
                            window.location.href = 'verify-code.php'
                        } else {
                            console.log(result['msg']);
                        }
                    },
                    error: function(error) {}
                });
            });
        });
    </script>
</body>

</html>