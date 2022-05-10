<?php
session_start();
if (!isset($_SESSION["_codeVToken"])) {
    $rstrong = true;
    $_SESSION["_codeVToken"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
}

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
    <h1>Verify</h1>
    <form id="verifyApplicantForm" method="post" enctype="multipart/form-data">
        <div>
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num1" id="num1" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num2" id="num2" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num3" id="num3" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num4" id="num4" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num5" id="num5" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num6" id="num6" class="num" placeholder="0">
        </div>
        <button type="submit">Verify</button>
        <input type="hidden" name="_cToken" value="<?php echo $_SESSION["_codeVToken"]; ?>">
    </form>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#verifyApplicantForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "api/verifyApplicantCode",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result["response"] == "success") {
                            console.log(result['msg']);
                            window.location.href = 'apply.php';
                        } else {
                            alert(result['msg'])
                        }
                    },
                    error: function(error) {}
                });
            });

            $(".num").on("keyup", function() {
                if (this.value) {
                    $(this).next(":input").focus();
                }
            })
        });
    </script>
</body>

</html>