<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        .app-proecess-info {
            display: flex !important;
            flex-direction: column;
            justify-content: space-between;
            align-items: baseline;
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            max-width: 480px !important;
            margin: 0 15px !important
        }

        .btn-card {
            text-align: center;
            color: #fff !important;
            padding: 20px;
            width: 100%;
            background: #003262;
            border-radius: 10px;
        }

        .btn-card:hover {
            color: #000 !important;
            border: 2px solid #003262;
        }

        .help_area {
            position: relative;
            top: 65%;
            float: right;
            right: 15px;
            z-index: 999;
        }

        .help_chat_area {
            display: none;
            width: 360px;
            height: 550px;
            position: absolute;
            top: 80px;
            float: right;
            right: 14px
        }

        footer {
            bottom: 0 !important;
            position: absolute !important;
        }
    </style>
</head>

<body>
    <header class="top-nav-bar card">
        <div class="info-card">OKAY</div>
        <div class="logo-board">
            <img src="assets/images/RMU-LOG.png" alt="" style="height: 100%;">`
            <h1>APPLICATION PORTAL</h1>
        </div>
    </header>

    <div id="bg-img"></div>

    <div class="main-content" style="z-index: 9;">
        <div class="app-proecess-info col-sm">
            <h1>Application Process</h1>
            <ul style="font-size: medium;">
                <li>Click <a href="https://forms.rmuictonline.com/buy-online/" title="Buy voucher online via Mobile Money and Credit Card"><b>here</b></a> to buy voucher online</li>
                <li>or buy vouchor from any of our <a href=""><b>vendors listed here</b></a></li>
            </ul>
            <div style="width: 100%; margin-top: 10px">
                <a href="apply/" class="btn-card btn">
                    <span>APPLY FOR A PROGRAMME</span>
                </a>
            </div>
        </div>

        <div class="help_area col-sm">
            <div class="help_chat_area"></div>
            <button style="padding: 5px 10px; cursor: pointer">Chat with us</button>
        </div>
    </div>
    <?php //require_once('./inc/page-footer.php') 
    ?>

</body>

</html>