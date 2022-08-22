<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: index.php?status=error&message=Invalid access!');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: index.php');
}

$user_id = $_SESSION['ghApplicant'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <!--<link rel="stylesheet" href="../assets/css/bootstrap.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body>
    <header class="top-nav-bar card">
        <div class="logo-board"></div>
        <div class="info-card">
            <div>Application Sections</div>
            <div>
                <a href="?logout=true" style="color: #fff !important">Logout</a>
            </div>
        </div>
    </header>

    <nav>

    </nav>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Personal Information</h1>
                        </div>

                        <hr>

                        <?php
                        require_once('../bootstrap.php');

                        use Src\Controller\UsersController;

                        $user = new UsersController();
                        $personal = $user->fetchApplicantPersI($user_id);

                        ?>
                        <form id="appForm" method="POST" style="margin-top: 50px !important;">
                            <fieldset class="fieldset">
                                <legend>Legal Name</legend>
                                <p style="margin-bottom: 30px !important">Please use your legal name. DO NOT use nicknames or abbreviations</p>
                                <div class="form-fields" style="flex-grow: 8;">
                                    <div class="mb-4">
                                        <label class="form-label" for="prefix">Prefix <span class="input-required">*</span></label>
                                        <select class="form-select form-select-sm mb-3" name="prefix" id="prefix">
                                            <option value="" hidden>Select</option>
                                            <option value="Mr." <?= $personal[0]["prefix"] == "Mr." ? "selected" : "" ?>>Mr.</option>
                                            <option value="Mrs." <?= $personal[0]["prefix"] == "Mrs." ? "selected" : "" ?>>Mrs.</option>
                                            <option value="Ms." <?= $personal[0]["prefix"] == "Ms." ? "selected" : "" ?>>Ms.</option>
                                            <option value="Prof. Dr." <?= $personal[0]["prefix"] == "Prof. Dr." ? "selected" : "" ?>>Prof. Dr.</option>
                                            <option value="Prof." <?= $personal[0]["prefix"] == "Prof." ? "selected" : "" ?>>Prof.</option>
                                            <option value="Rev." <?= $personal[0]["prefix"] == "Rev." ? "selected" : "" ?>>Rev.</option>
                                            <option value="Rev. Dr." <?= $personal[0]["prefix"] == "Rev. Dr." ? "selected" : "" ?>>Rev. Dr.</option>
                                            <option value="Rev. Sis." <?= $personal[0]["prefix"] == "Rev. Sis." ? "selected" : "" ?>>Rev. Sis.</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="first-name">First Name <span class="input-required">*</span></label>
                                        <input class="form-control" type="text" name="first-name" id="first-name" value="<?= $personal[0]["first_name"] ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="middle-name">Middle Names <span>(Optional)</span></label>
                                        <input class="form-control" type="text" name="middle-name" id="middle-nams" value="<?= $personal[0]["middle_name"] ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="last-name">Surname<span class="input-required">*</span></label>
                                        <input class="form-control" type="text" name="last-name" id="last-name" value="<?= $personal[0]["last_name"] ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="suffix">Suffix <span>(Optional)</span></label>
                                        <select class="form-select form-select-sm mb-3" name="suffix" id="suffix">
                                            <option value="" hidden>Select</option>
                                            <option value="Jr." <?= $personal[0]["suffix"] == "Jr." ? "selected" : "" ?>>Jr.</option>
                                            <option value="Sr." <?= $personal[0]["suffix"] == "Sr." ? "selected" : "" ?>>Sr.</option>
                                            <option value="I" <?= $personal[0]["suffix"] == "I" ? "selected" : "" ?>>I</option>
                                            <option value="II" <?= $personal[0]["suffix"] == "II" ? "selected" : "" ?>>II</option>
                                            <option value="III" <?= $personal[0]["suffix"] == "III" ? "selected" : "" ?>>III</option>
                                            <option value="IV" <?= $personal[0]["suffix"] == "IV" ? "selected" : "" ?>>IV</option>
                                            <option value="V" <?= $personal[0]["suffix"] == "V" ? "selected" : "" ?>>V</option>
                                            <option value="J.D." <?= $personal[0]["suffix"] == "J.D." ? "selected" : "" ?>>J.D.</option>
                                            <option value="Esq" <?= $personal[0]["suffix"] == "Esq" ? "selected" : "" ?>>Esq</option>
                                            <option value="M.D." <?= $personal[0]["suffix"] == "M.D." ? "selected" : "" ?>>M.D.</option>
                                            <option value="O.F.M." <?= $personal[0]["suffix"] == "O.F.M." ? "selected" : "" ?>>O.F.M.</option>
                                            <option value="O.P." <?= $personal[0]["suffix"] == "O.P." ? "selected" : "" ?>>O.P.</option>
                                            <option value="Ph.D." <?= $personal[0]["suffix"] == "Ph.D." ? "selected" : "" ?>>Ph.D.</option>
                                            <option value="S.J." <?= $personal[0]["suffix"] == "S.J." ? "selected" : "" ?>>S.J.</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Personal Details</legend>
                                <div class="field-content">
                                    <div class="form-fields" style="flex-grow: 8;">
                                        <div class="mb-4">
                                            <label class="form-label" for="gender">Gender <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="gender" id="gender">
                                                <option value="" hidden>Select</option>
                                                <option value="Male" <?= $personal[0]["gender"] == "Male" ? "selected" : "" ?>>Male</option>
                                                <option value="Female" <?= $personal[0]["gender"] == "Female" ? "selected" : "" ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="dob">Date of Birth <span class="input-required">*</span></label>
                                            <input class="form-control" type="text" maxlength="10" name="dob" id="dob" placeholder="DD/MM/YYYY" value="<?= $personal[0]["dob"] ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="marital-status">Marital Status <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="marital-status" id="marital-status">
                                                <option value="" hidden>Select</option>
                                                <option value="Single" <?= $personal[0]["marital_status"] == "Single" ? "selected" : "" ?>>Single</option>
                                                <option value="Married" <?= $personal[0]["marital_status"] == "Married" ? "selected" : "" ?>>Married</option>
                                                <option value="Divorced" <?= $personal[0]["marital_status"] == "Divorced" ? "selected" : "" ?>>Divorced</option>
                                                <option value="Widowed" <?= $personal[0]["marital_status"] == "Widowed" ? "selected" : "" ?>>Widowed</option>
                                                <option value="Separarted" <?= $personal[0]["marital_status"] == "Separarted" ? "selected" : "" ?>>Separated</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="nationality">Nationality <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="nationality" id="nationality">
                                                <option value="" hidden>Select</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="country-res">Country of Residence <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="country-res" id="country-res">
                                                <option value="" hidden>Select</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="disability">Any Disability <span class="input-required">*</span></label>
                                            <label class="form-check-label" for="disability-yes">
                                                <input style="margin-left: 20px;" type="radio" name="disability" id="disability-yes" value="yes" <?= $personal[0]["disability"] == 1 ? "checked" : "" ?>> Yes
                                            </label>
                                            <label class="form-check-label" for="disability-no">
                                                <input style="margin-left: 20px;" type="radio" name="disability" id="disability-no" value="no" <?= $personal[0]["disability"] == 0 ? "checked" : "" ?>> No
                                            </label>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="disability">Select Disability <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="disability-descript" id="disability-descript">
                                                <option value="" hidden>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Place of Birth</legend>

                                <div class="mb-4">
                                    <label for="country-birth" class="form-label">Country of Birth <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="country-birth" id="country-birth">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="region-birth">State / Province / Region <span>(Optional)</span></label>
                                    <select class="form-select form-select-sm mb-3" name="region-birth" id="region-birth">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="home-town">City of birth <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="home-town" id="home-town" value="<?= $personal[0]["city_birth"] ?>">
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Language</legend>

                                <div class="mb-4">
                                    <label class="form-label" for="english-native">English Native <span class="input-required">*</span></label>
                                    <label for="english-native-yes">
                                        <input style="margin-left: 20px;" type="radio" name="english-native" id="english-native-yes" value="Yes" <?= $personal[0]["english_native"] == 1 ? "checked" : "" ?>> Yes
                                    </label>
                                    <label for="english-native-no">
                                        <input style="margin-left: 20px;" type="radio" name="english-native" id="english-native-no" value="No" <?= $personal[0]["english_native"] == 0 ? "checked" : "" ?>> No
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="english-native">Do you understand and speak some english? <span class="input-required">*</span></label>
                                    <label for="english-native-yes">
                                        <input style="margin-left: 20px;" type="radio" name="und-speak-english" id="und-speak-english-yes" value="Yes" <?= $personal[0]["english_native"] == 1 ? "checked" : "" ?>> Yes
                                    </label>
                                    <label for="english-native-no">
                                        <input style="margin-left: 20px;" type="radio" name="und-speak-english" id="und-speak-english-no" value="No" <?= $personal[0]["english_native"] == 0 ? "checked" : "" ?>> No
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="language-spoken">Speicfy Language</label>
                                    <select class="form-select form-select-sm mb-3" name="language-spoken" id="language-spoken">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Address</legend>
                                <div class="mb-4">
                                    <label class="form-label" for="address-line1">Address Line 1 <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="address-line1" id="address-line1" value="<?= $personal[0]["postal_addr"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-line2">Address Line 2 <span>(Optional)</span></label>
                                    <input class="form-control" type="text" name="address-line2" id="address-line2" value="<?= $personal[0]["postal_addr"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-country">Country <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="address-country" id="address-country">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-region">State / Privince / Region <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="address-region" id="address-region" value="<?= $personal[0]["postal_spr"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-town">City <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="address-town" id="address-town" value="<?= $personal[0]["postal_town"] ?>">
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Contact</legend>
                                <div class="mb-4">
                                    <label class="form-label" for="app-phone-number">Primary Phone Number <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="app-phone-number" id="app-phone-number" value="<?= $personal[0]["phone_no1"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="app-other-number"> Other Phone Number <span>(Optional)</span></label>
                                    <input class="form-control" type="text" name="app-other-number" id="app-other-number" value="<?= $personal[0]["phone_no2"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="app-email-address">Email Address <span class="input-required">*</span></label>
                                    <input class="form-control" type="email" name="app-email-address" id="app-email-address" value="<?= $personal[0]["email_addr"] ?>">
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Parent / Guardian Information</legend>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-prefix">Prefix <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="gd-prefix" id="gd-prefix">
                                        <option value="" hidden>Select</option>
                                        <option value="Mr." <?= $personal[0]["p_prefix"] == "Mr." ? "selected" : "" ?>>Mr.</option>
                                        <option value="Mrs." <?= $personal[0]["p_prefix"] == "Mrs." ? "selected" : "" ?>>Mrs.</option>
                                        <option value="Ms." <?= $personal[0]["p_prefix"] == "Ms." ? "selected" : "" ?>>Ms.</option>
                                        <option value="Prof. Dr." <?= $personal[0]["p_prefix"] == "Prof. Dr." ? "selected" : "" ?>>Prof. Dr.</option>
                                        <option value="Prof." <?= $personal[0]["p_prefix"] == "Prof." ? "selected" : "" ?>>Prof.</option>
                                        <option value="Rev." <?= $personal[0]["p_prefix"] == "Rev." ? "selected" : "" ?>>Rev.</option>
                                        <option value="Rev. Dr." <?= $personal[0]["p_prefix"] == "Rev. Dr." ? "selected" : "" ?>>Rev. Dr.</option>
                                        <option value="Rev. Sis." <?= $personal[0]["p_prefix"] == "Rev. Sis." ? "selected" : "" ?>>Rev. Sis.</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-surname">Surname <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="gd-surname" id="gd-surname" value="<?= $personal[0]["p_last_name"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-first-name">First Name <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="gd-first-name" id="gd-first-name" value="<?= $personal[0]["p_first_name"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-occupation">Occupation <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="gd-occupation" id="gd-occupation" value="<?= $personal[0]["p_occupation"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-phone-number">Phone Number <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="gd-country" id="gd-country">
                                        <option value="" hidden>Select</option>
                                        <option value="Single" selected>+233</option>
                                        <option value="Married">+234</option>
                                        <option value="Divorced">+235</option>
                                        <option value="Widowed">+236</option>
                                        <option value="Separarted">+237</option>
                                    </select>
                                    <input class="form-control" type="tel" name="gd-phone-number" id="phone-number" value="<?= $personal[0]["p_phone_no"] ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-email-address">Email Address</label>
                                    <input class="form-control" type="email" name="gd-email-address" id="gd-email-address" value="<?= $personal[0]["p_email_addr"] ?>">
                                </div>
                            </fieldset>

                        </form>

                        <center>
                            <div class="page-control">
                                <!--<button type="submit" id="prevStep" onclick="whatNext(0)" class="m-5 control-button btn">Previous Step</button>-->
                                <button type="button" id="saveAndExit" onclick="whatNext(1)" class="m-3 btn btn-default">Save and Exit</button>
                                <button type="button" id="saveAndCont" onclick="whatNext(2)" class="m-3 btn btn-primary">Next -> Academic Background</button>
                            </div>
                        </center>
                    </main>
                </div>

                <!-- Application progress tracker -->
                <section class="col-3" style="margin-bottom: 400px;">

                    <div class="container-sm" style=" display: flex; flex-direction: column;position: sticky; top: 10.7rem;">
                        <fieldset class="fieldset" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
                            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
                            <span class="mb-5">In progress</span>
                            <ul class="list-group mt-5" style="padding: 0 !important; margin: 0 important; font-size:medium; font-weight:500">
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Use of Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step1.php" class=" active">Personal Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step2.php">Acedemic Background</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step3.php">Programme Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step4.php">Uploads</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step5.php">Declaration</a>
                                </li>
                            </ul>
                        </fieldset>

                        <fieldset class="fieldset" style="display: flex; flex-direction: column; align-items:center; max-width: 270px; min-width: 270px;">
                            <legend style="width:100%; text-align: center;">Need Help?</legend>
                            <p style="width: 100%;">
                                <span class="bi bi-telephone-fill"></span>
                                <a href=" tel:+233302712775">+233302712775</a>
                            </p>
                            <p style="width: 100%;">
                                <span class="bi bi-envelope-fill"></span>
                                <a href="mailto:university.registrar@rmu.edu.gh">university.registrar@rmu.edu.gh</a>
                            </p>
                        </fieldset>

                    </div>

                </section>

            </div>
        </div>

        <?php require_once('../inc/page-footer.php') ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            getData(document.getElementById("nationality"), 'c');
            getData(document.getElementById("country-res"), 'c');
            //getData(document.getElementById("postal-country"), 'c');
            getData(document.getElementById("country-birth"), 'c');
            getData(document.getElementById("address-country"), 'c');
            //getData(document.getElementById("region"), 'r');

            $(".form-select").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../api/personal",
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
                    url: "../api/personal",
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