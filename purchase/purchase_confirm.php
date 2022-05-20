<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>

<body>
    <h1>Next</h1>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "../api/verifyStepFinal",
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    console.log(result);
                    /*if (res["response"] == "success") {
                        console.log(res['msg']);
                        window.location.href = 'verify-code.php'
                    } else {
                        console.log(res['msg']);
                    }*/
                },
                error: function(error) {}
            });
        });
    </script>
</body>

</html>