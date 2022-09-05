<?php
require_once("../../inc/head-section.php");
$page = array("id" => 3, "name" => "Programmes Information");
?>

<body>

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Programmes Information</h1>
                        </div>

                        <hr>

                        <!-- Page form -->
                        <?php require_once("forms/programmes-information.php") ?>

                        <!-- Bottom page navigation -->
                        <?php require_once("../../inc/bottom-page-section.php"); ?>

                    </main>
                </div>

                <!-- Right page navigation and help div -->
                <?php require_once("../../inc/right-page-section.php"); ?>

            </div>
        </div>
        <?php require_once('../../inc/app-page-footer.php') ?>
    </div>

    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/myjs.js"></script>
    <script>
        $(document).ready(function() {

            if ($("#how-heard-about").is(":selected")) {
                $("#other-heard").addClass("display");
            }

            $("#hear-about-prog").on("change", function() {
                if (this.value == "Other") {
                    $("#other-heard").addClass("display");
                } else {
                    $("#other-heard").removeClass("display");
                    $("#other-heard").addClass("hide");
                }

            })

            if ($("#earn-grad-deg-yes").is(":checked")) {
                alert("")
            }
        });
    </script>
</body>

</html>