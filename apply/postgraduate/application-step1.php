<?php
require_once("../../inc/head-section.php");
$page = array("id" => 1, "name" => "Personal Information");
?>

<body>

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Personal Information</h1>
                        </div>

                        <hr>

                        <!-- Page form -->
                        <?php require_once("forms/personal-information.php") ?>

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
            getData(document.getElementById("nationality"), 'c');
            getData(document.getElementById("country-res"), 'c');
            //getData(document.getElementById("postal-country"), 'c');
            getData(document.getElementById("country-birth"), 'c');
            getData(document.getElementById("address-country"), 'c');
            //getData(document.getElementById("region"), 'r');

            $(".disability").click(function() {
                if ($('#disability-yes').is(':checked')) {
                    $("#disability-list").removeClass("hide");
                } else if ($('#disability-no').is(':checked')) {
                    $("#disability-list").addClass("hide");
                }
            });

            $(".english-native").click(function() {
                if ($('#english-native-yes').is(':checked')) {
                    $("#english-native-list").addClass("hide");
                } else if ($('#english-native-no').is(':checked')) {
                    $("#english-native-list").removeClass("hide");
                }
            });

            $(".form-select").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/personal",
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
                    url: "../../api/personal",
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

            $(".form-radio").on("click", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/personal",
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
        });
    </script>
</body>

</html>