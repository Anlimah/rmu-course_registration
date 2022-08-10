<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghAppLogin']))) {
        header('Location: index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: index.php?status=error&message=Invalid access!');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body>
    <header class="top-nav-bar card">
        <div class="logo-board"></div>
        <div class="info-card"></div>
    </header>

    <nav>

    </nav>

    <div class="main-content">
        <div class="conatainer">
            <div class="row">
                <div class="col-8">
                    <main class=" container">
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Personal Information</h1>
                        </div>

                        <hr>

                        <form id="appForm" method="POST" style="margin-top: 50px !important;">
                            <fieldset class="fieldset">
                                <legend>Legal Name</legend>
                                <p style="margin-bottom: 30px !important">Please use your legal name. DO NOT use nicknames or abbreviations</p>
                                <div class="field-content">
                                    <div class="form-fields" style="flex-grow: 8;">
                                        <div class="mb-4">
                                            <label class="form-label" for="prefix">Prefix <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="prefix" id="prefix">
                                                <option value="" hidden>Select</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Prof. Dr.">Prof. Dr.</option>
                                                <option value="Prof.">Prof.</option>
                                                <option value="Rev.">Rev.</option>
                                                <option value="Rev. Dr.">Rev. Dr.</option>
                                                <option value="Rev. Sis.">Rev. Sis.</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="first-name">First Name <span class="input-required">*</span></label>
                                            <input class="form-control" type="text" name="first-name" id="first-name">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="middle-name">Middle Names <span>(Optional)</span></label>
                                            <input class="form-control" type="text" name="middle-name" id="middle-nams">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="last-name">Surname<span class="input-required">*</span></label>
                                            <input class="form-control" type="text" name="last-name" id="last-name">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="suffix">Suffix <span>(Optional)</span></label>
                                            <select class="form-select form-select-sm mb-3" name="suffix" id="suffix">
                                                <option value="" hidden>Select</option>
                                                <option value="Mr.">Jr.</option>
                                                <option value="Mrs.">Sr.</option>
                                                <option value="Ms.">I</option>
                                                <option value="Ms.">II</option>
                                                <option value="Ms.">III</option>
                                                <option value="Ms.">IV</option>
                                                <option value="Ms.">V</option>
                                                <option value="Prof. Dr.">J.D.</option>
                                                <option value="Prof.">Esq</option>
                                                <option value="Rev.">M.D.</option>
                                                <option value="Rev. Dr.">O.F.M.</option>
                                                <option value="Rev. Sis.">O.P</option>
                                                <option value="Rev. Sis.">Ph.D.</option>
                                                <option value="Rev. Sis.">S.J.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Passport Picture</legend>

                                <div class="field-content">
                                    <div class="form-fields" style="flex-grow: 8;">
                                        <div class="photo-upload-area">
                                            <p style="font-size: 14px; color: brown">Please upload a passport size photo of yourself. The size of the image should not be more than 100KB. The background color of your image should be white.</p>
                                            <p style="font-size: 14px; color: red"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>
                                            <div class="photo-display"></div>
                                            <label for="applicant-photo" class="upload-photo-label btn btn-primary">Upload photo</label>
                                            <input class="form-control" type="file" style="display: none;" name="applicant-photo" id="applicant-photo">
                                        </div>
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
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="dob">Date of Birth <span class="input-required">*</span></label>
                                            <input class="form-control" type="text" maxlength="2" name="dob-day" id="dob" placeholder="DD/MM/YYYY">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="marital-status">Marital Status <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="marital-status" id="marital-status">
                                                <option value="" hidden>Select</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Separarted">Separated</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="nationality">Nationality <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="nationality" id="nationality">
                                                <option value="" hidden>Select</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="country">Country of Residence <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="country" id="country">
                                                <option value="" hidden>Select</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="disability">Any Disability <span class="input-required">*</span></label>
                                            <label class="form-check-label" for="disability-yes">
                                                <input style="margin-left: 20px;" type="radio" name="disability" id="disability-yes" value="yes"> Yes
                                            </label>
                                            <label class="form-check-label" for="disability-no">
                                                <input style="margin-left: 20px;" type="radio" name="disability" id="disability-no" value="no"> No
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
                                    <label for="country" class="form-label">Country of Birth <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="postal-country" id="postal-country">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="region">State / Province / Region <span>(Optional)</span></label>
                                    <select class="form-select form-select-sm mb-3" name="region" id="region">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="home-town">City of birth <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="home-town" id="home-town">
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Language</legend>

                                <div class="mb-4">
                                    <label class="form-label" for="english-native">English Native <span class="input-required">*</span></label>
                                    <label for="english-native-yes">
                                        <input style="margin-left: 20px;" type="radio" name="english-native" id="english-native-yes"> Yes
                                    </label>
                                    <label for="english-native-no">
                                        <input style="margin-left: 20px;" type="radio" name="english-native" id="english-native-no"> No
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="other-native">Speicfy Language</label>
                                    <select class="form-select form-select-sm mb-3" name="other-native" id="other-native">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Address</legend>
                                <div class="mb-4">
                                    <label class="form-label" for="address-line1">Address Line 1 <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="address-line1" id="address-line1">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-line2">Address Line 2 <span>(Optional)</span></label>
                                    <input class="form-control" type="text" name="address-line2" id="address-line2">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-country">Country <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="address-country" id="address-country">
                                        <option value="" hidden>Select</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-region">State / Privince / Region <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="address-region" id="address-region">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="address-town">City <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="address-town" id="address-town">
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Contact</legend>
                                <div class="mb-4">
                                    <label class="form-label" for="app-phone-number">Primary Phone Number <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="app-phone-number" id="app-phone-number">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="app-phone-number"> Other Phone Number <span>(Optional)</span></label>
                                    <input class="form-control" type="text" name="app-phone-number" id="app-phone-number">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="app-email-address">Email Address <span class="input-required">*</span></label>
                                    <input class="form-control" type="email" name="app-email-address" id="app-email-address">
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Parent / Guardian Information</legend>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-title">Prefix <span class="input-required">*</span></label>
                                    <select class="form-select form-select-sm mb-3" name="gd-title" id="gd-title">
                                        <option value="" hidden>Select</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mr">Mrs.</option>
                                        <option value="Mr">Ms.</option>
                                        <option value="Mr">Prof. Dr.</option>
                                        <option value="Mr">Prof.</option>
                                        <option value="Mr">Rev.</option>
                                        <option value="Mr">Rev. Dr.</option>
                                        <option value="Mr">Rev. Sis.</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-surname">Surname <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="gd-surname" id="gd-surname">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-first-name">First Name <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="gd-first-name" id="gd-first-name">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-occupation">Occupation <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="gd-occupation" id="gd-occupation">
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
                                    <input class="form-control" type="tel" name="gd-phone-number" id="phone-number">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="gd-email-address">Email Address</label>
                                    <input class="form-control" type="email" name="gd-email-address" id="gd-email-address">
                                </div>
                            </fieldset>

                        </form>

                        <center>
                            <div class="page-control">
                                <!--<button type="submit" id="prevStep" onclick="whatNext(0)" class="m-5 control-button btn">Previous Step</button>-->
                                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="m-5 control-button btn">Save and Exit</button>
                                <button type="submit" id="saveAndCont" onclick="whatNext(2)" class="m-5 control-button btn">Next</button>
                            </div>
                        </center>
                    </main>
                </div>

                <!-- Application progress tracker -->
                <div class="col-4" style="margin-bottom: 400px;">

                    <section class="container-sm" style=" display: flex; flex-direction: column;position: sticky; top: 10.7rem;">
                        <fieldset class="fieldset" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
                            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
                            <span class="mb-5">In progress</span>
                            <ul class="list-group mt-5" style="padding: 0 !important; margin: 0 important; font-size:medium; font-weight:500">
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="/">Use of Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="" class="active">Personal Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="">Acedemic Background</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="">Programme Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="">Uploads</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="">Declaration</a>
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

                    </section>

                </div>

            </div>
        </div>

        <?php require_once('../inc/page-footer.php') ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            getData(document.getElementById("nationality"), 'c');
            getData(document.getElementById("country"), 'c');
            getData(document.getElementById("postal-country"), 'c');
            getData(document.getElementById("region"), 'r');

            $("#appForm").on("submit", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                save(data, 1);
            });

            $(".form-control, .form-select").on("blur", function() {
                $.ajax({
                    type: "POST",
                    url: "../api/saveOne",
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