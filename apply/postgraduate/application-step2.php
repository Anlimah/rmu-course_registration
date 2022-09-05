<?php
require_once("../../inc/head-section.php");
$page = array("id" => 2, "name" => "Education Background");
?>

<body>

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Education Background</h1>
                        </div>

                        <hr>

                        <!-- Page form -->
                        <?php require_once("forms/education-background.php") ?>

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
    <!--<script src="../../js/myjs.js"></script>-->
    <script>
        $(document).ready(function() {

            $(".prev-uni-rec").click(function() {
                if ($('#prev-uni-rec-yes').is(':checked')) {
                    $("#prev-uni-yes").removeClass("yes-disability");
                } else if ($('#prev-uni-rec-yes').is(':checked')) {
                    $("#prev-uni-yes").addClass("yes-disability");
                }
            });

            $(".form-select").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/education",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $(".form-control").on("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/education",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

            let start = 1;
            let end = 3;
            let next = 1;

            $("#nextStep").click(function() {
                if (start => 1 && start < end) {
                    next = start + 1;
                    $(".steps").addClass("hide");
                    $(".steps").removeClass("display");
                    $("#step-" + next).removeClass("hide");
                    $("#step-" + next).addClass("display");
                    $("#prevStep").removeClass("hide");
                    $("#prevStep").addClass("display");
                }
            });

            $("#prevStep").click(function() {
                if (next > 1 && next <= end) {
                    next = next - 1;
                    $(".steps").addClass("hide");
                    $(".steps").removeClass("display");
                    $("#step-" + next).removeClass("hide");
                    $("#step-" + next).addClass("display");
                }
            });
        });
    </script>
</body>

</html>