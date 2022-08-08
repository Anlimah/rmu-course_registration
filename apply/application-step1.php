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
    <link rel="stylesheet" href="../assets/css/application-form.css">
</head>

<body>
    <header class="top-bar card">
        <div class="logo-board"></div>
        <div class="info-card"></div>
    </header>

    <nav>

    </nav>

    <div class="main-content">
        <main>
            <div class="page_info" style="margin-bottom: 50px; border-bottom: 1px solid #909090">
                <h1 style="font-size: 40px; padding-bottom: 15px">Personal Information</h1>
            </div>

            <form id="appForm" method="POST">
                <fieldset class="fieldset">
                    <legend>Legal Name</legend>
                    <p style="margin-bottom: 30px;">Please use your legal name. DO NOT use nicknames or abbreviations</p>
                    <div class="field-content">
                        <div class="form-fields" style="flex-grow: 8;">
                            <div>
                                <label for="title">Prefix <span class="input-required">*</span></label>
                                <select name="title" id="title">
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
                            <div>
                                <label for="other-names">First Name <span class="input-required">*</span></label>
                                <input type="text" name="other-names" id="other-names">
                            </div>
                            <div>
                                <label for="other-names">Middle Names <span>(Optional)</span></label>
                                <input type="text" name="other-names" id="other-names">
                            </div>
                            <div>
                                <label for="surname">Surname<span class="input-required">*</span></label>
                                <input type="text" name="surname" id="surname">
                            </div>
                            <div>
                                <label for="title">Suffix <span>(Optional)</span></label>
                                <select name="title" id="title">
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
                    <legend>Personal Details</legend>
                    <div class="field-content">
                        <div class="form-fields" style="flex-grow: 8;">
                            <div>
                                <label for="gender">Gender <span class="input-required">*</span></label>
                                <select name="gender" id="gender">
                                    <option value="" hidden>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="dob">Date of Birth <span class="input-required">*</span></label>

                                <input type="text" maxlength="2" style="width: 30px; text-align: center;" name="dob-day" id="dob" placeholder="dd"> /
                                <input type="text" maxlength="2" style="width: 30px; text-align: center;" name="dob-month" id="dob" placeholder="mm"> /
                                <input type="text" maxlength="4" style="width: 70px; text-align: center;" name="dob-year" id="dob" placeholder="yyyy">
                            </div>
                            <div>
                                <label for="marital-status">Marital Status <span class="input-required">*</span></label>
                                <select name="marital-status" id="marital-status">
                                    <option value="" hidden>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separarted">Separated</option>
                                </select>
                            </div>
                            <div>
                                <label for="nationality">Nationality <span class="input-required">*</span></label>
                                <select name="nationality" id="nationality" class="countryList">>
                                    <option value="" hidden>Select</option>
                                </select>
                            </div>
                            <div>
                                <label for="country">Country of Residence <span class="input-required">*</span></label>
                                <select name="country" id="country" class="countryList">
                                    <option value="" hidden>Select</option>
                                </select>
                            </div>
                            <div>
                                <label for="disability">Any Disability <span class="input-required">*</span></label>
                                <span>
                                    <input type="radio" name="disability" id="disability-yes">
                                    <span>Yes</span>
                                </span>
                                <span>
                                    <input type="radio" name="disability" id="disability-no">
                                    <span>No</span>
                                </span>
                            </div>
                            <div>
                                <label for="disability">Select Disability <span class="input-required">*</span></label>
                                <select name="disability-descript" id="disability-descript">
                                    <option value="" hidden>Select</option>
                                </select>
                            </div>
                            <div class="field-content">
                                <div class="form-fields" style="flex-grow: 8;">
                                </div>
                                <div class="photo-upload-area">
                                    <p style="font-size: 14px; color: brown">Please upload a passport size photo of yourself. The size of the image should not be more than 100KB.</p>
                                    <p style="font-size: 14px; color: brown">The background color of your image should be white.</p>
                                    <p style="font-size: 14px; color: red"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>
                                    <div class="photo-display"></div>
                                    <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload photo <span class="input-required">*</span></label>
                                    <input type="file" name="applicant-photo" id="applicant-photo">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Place of Birth</legend>

                    <div>
                        <label for="country">Country of Birth <span class="input-required">*</span></label>
                        <select name="postal-country" id="postal-country" class="countryList">
                            <option value="" hidden>Select</option>
                        </select>
                    </div>
                    <div>
                        <label for="region">State / Province / Region <span>(Optional)</span></label>
                        <select name="region" id="region">
                            <option value="" hidden>Select</option>
                        </select>
                    </div>
                    <div>
                        <label for="home-town">City of birth <span class="input-required">*</span></label>
                        <input type="text" name="home-town" id="home-town">
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Languages</legend>

                    <div>
                        <label for="english-native">English Native <span class="input-required">*</span></label>
                        <span>
                            <input type="radio" name="english-native" id="english-native-yes">
                            <span>Yes</span>
                        </span>
                        <span>
                            <input type="radio" name="english-native" id="english-native-no">
                            <span>No</span>
                        </span>
                    </div>
                    <div>
                        <label for="other-native">Speicfy Language</label>
                        <select name="other-native" id="other-native">
                            <option value="" hidden>Select</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Address</legend>
                    <div>
                        <label for="address-line1">Address Line 1 <span class="input-required">*</span></label>
                        <input type="text" name="address-line1" id="address-line1">
                    </div>
                    <div>
                        <label for="address-line2">Address Line 2 <span>(Optional)</span></label>
                        <input type="text" name="address-line2" id="address-line2">
                    </div>
                    <div>
                        <label for="address-country">Country <span class="input-required">*</span></label>
                        <select name="address-country" id="address-country" class="countryList">
                            <option value="" hidden>Select</option>
                        </select>
                    </div>
                    <div>
                        <label for="address-region">State / Privince / Region <span class="input-required">*</span></label>
                        <input type="text" name="address-region" id="address-region">
                    </div>
                    <div>
                        <label for="address-town">City <span class="input-required">*</span></label>
                        <input type="text" name="address-town" id="address-town">
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Contact</legend>
                    <div>
                        <label for="app-phone-number">Primary Phone Number <span class="input-required">*</span></label>
                        <input type="text" name="app-phone-number" id="app-phone-number">
                    </div>
                    <div>
                        <label for="app-phone-number"> Other Phone Number <span>(Optional)</span></label>
                        <input type="text" name="app-phone-number" id="app-phone-number">
                    </div>
                    <div>
                        <label for="app-email-address">Email Address <span class="input-required">*</span></label>
                        <input type="email" name="app-email-address" id="app-email-address">
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Parent / Guardian Information</legend>
                    <div>
                        <label for="gd-title">Prefix <span class="input-required">*</span></label>
                        <select name="gd-title" id="gd-title">
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
                    <div>
                        <label for="gd-surname">Surname <span class="input-required">*</span></label>
                        <input type="text" name="gd-surname" id="gd-surname">
                    </div>
                    <div>
                        <label for="gd-first-name">First Name <span class="input-required">*</span></label>
                        <input type="text" name="gd-first-name" id="gd-first-name">
                    </div>
                    <div>
                        <label for="gd-occupation">Occupation <span class="input-required">*</span></label>
                        <input type="text" name="gd-occupation" id="gd-occupation">
                    </div>
                    <div>
                        <label for="gd-phone-number">Phone Number <span class="input-required">*</span></label>
                        <select name="gd-country" id="gd-country">
                            <option value="" hidden>Select</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                        <input type="tel" name="gd-phone-number" id="phone-number">
                    </div>
                    <div>
                        <label for="gd-email-address">Email Address</label>
                        <input type="email" name="gd-email-address" id="gd-email-address">
                    </div>
                </fieldset>
            </form>

            <center>
                <div class="page-control">
                    <button type="submit" id="prevStep" onclick="whatNext(0)" class="control-button btn">Previous Step</button>
                    <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="control-button btn">Save and Exit</button>
                    <button type="submit" id="saveAndCont" onclick="whatNext(2)" class="control-button btn">Save and Continue</button>
                </div>
            </center>
        </main>

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

        });
    </script>
</body>

</html>