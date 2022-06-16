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
    <link rel="stylesheet" href="../assets/css/application-form.css">
</head>

<body>
    <div class="top-bar card">
        <div class="info-card"></div>
        <div class="logo-board"></div>
    </div>
    <main>
        <form id="appForm" method="POST">
            <fieldset>
                <legend style="padding: 5px; color:#fff; background-color: #000">Applicant Information</legend>
                <fieldset>
                    <legend>Personal</legend>
                    <div class="field-content">
                        <div class="form-fields" style="flex-grow: 8;">
                            <div>
                                <label for="title">Title</label>
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
                                <label for="surname">Surname</label>
                                <input type="text" name="surname" id="surname">
                            </div>
                            <div>
                                <label for="first-name">First Name</label>
                                <input type="text" name="first-name" id="first-name">
                            </div>
                            <div>
                                <label for="other-names">Other Names</label>
                                <input type="text" name="other-names" id="other-names">
                            </div>
                            <div>
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" id="dob">
                            </div>
                            <div>
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="" hidden>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="marital-status">Marital Status</label>
                                <select name="marital-status" id="marital-status">
                                    <option value="" hidden>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separarted">Separarted</option>
                                </select>
                            </div>
                            <div>
                                <label for="nationality">Nationality</label>
                                <select name="nationality" id="nationality">
                                    <option value="" hidden>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separarted">Separarted</option>
                                </select>
                            </div>
                            <div>
                                <label for="country">Country of Residence</label>
                                <select name="country" id="country">
                                    <option value="" hidden>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separarted">Separarted</option>
                                </select>
                            </div>
                            <div>
                                <label for="region">Home Region</label>
                                <select name="region" id="region">
                                    <option value="" hidden>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separarted">Separarted</option>
                                </select>
                            </div>
                            <div>
                                <label for="home-town">Home Town</label>
                                <input type="text" name="home-town" id="home-town">
                            </div>
                            <div>
                                <label for="disability">Any Disability</label>
                                <select name="disability" id="disability">
                                    <option value="" hidden>Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="photo-upload-area">
                            <p style="font-size: 14px; color: brown">Please upload a passport size photo of yourself. The size of the image should not be more than 100KB.</p>
                            <p style="font-size: 14px; color: brown">The background color of your image should be white.</p>
                            <p style="font-size: 14px; color: red"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>
                            <div class="photo-display"></div>
                            <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload photo</label>
                            <input type="file" name="" id="applicant-photo">
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Contact</legend>
                    <div>
                        <label for="app-postal-address">Postal Address</label>
                        <input type="text" name="app-postal-address" id="app-postal-address">
                    </div>
                    <div>
                        <label for="app-postal-town">Postal Town</label>
                        <input type="text" name="app-postal-town" id="app-postal-town">
                    </div>
                    <div>
                        <label for="app-postal-region">Postal Region</label>
                        <input type="text" name="app-postal-region" id="app-postal-region">
                    </div>
                    <div>
                        <label for="app-residence">Residential Address</label>
                        <input type="text" name="app-residence" id="app-residence">
                    </div>
                    <div>
                        <label for="app-phone-number">Mobile Phone Number</label>
                        <input type="text" name="app-phone-number" id="app-phone-number">
                    </div>
                    <div>
                        <label for="app-email-address">Email Address</label>
                        <input type="email" name="app-email-address" id="app-email-address">
                    </div>

                </fieldset>
            </fieldset>

            <fieldset>
                <legend>Parent/Guardian Information</legend>
                <fieldset>
                    <legend>Personal</legend>
                    <div>
                        <label for="gd-title">Title</label>
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
                        <label for="gd-surname">Surname</label>
                        <input type="text" name="gd-surname" id="gd-surname">
                    </div>
                    <div>
                        <label for="gd-first-name">First Name</label>
                        <input type="text" name="gd-first-name" id="gd-first-name">
                    </div>
                    <div>
                        <label for="gd-phone-number">Phone Number</label>
                        <select name="country" id="country">
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
                        <label for="gd-occupation">Occupation</label>
                        <input type="text" name="gd-occupation" id="gd-occupation">
                    </div>
                    <div>
                        <label for="gd-email-address">Email Address</label>
                        <input type="email" name="gd-email-address" id="gd-email-addres">
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Contact</legend>
                    <div>
                        <label for="gd-postal-address">Postal Address</label>
                        <input type="text" name="gd-postal-address" id="gd-postal-address">
                    </div>
                    <div>
                        <label for="gd-postal-town">Postal Town</label>
                        <input type="text" name="gd-postal-town" id="gd-postal-town">
                    </div>
                    <div>
                        <label for="gd-postal-region">Postal Region</label>
                        <input type="text" name="gd-postal-region" id="gd-postal-region">
                    </div>
                    <div>
                        <label for="gd-residence">Residential Address</label>
                        <input type="text" name="gd-residence" id="gd-residence">
                    </div>
                    <div>
                        <label for="gd-phone-number">Mobile Phone Number</label>
                        <input type="text" name="gd-phone-number" id="gd-phone-number">
                    </div>
                    <div>
                        <label for="gd-email-address">Email Address</label>
                        <input type="email" name="gd-email-address" id="gd-email-address">
                    </div>

                </fieldset>
            </fieldset>

            <div class="page-control">
                <button type="submit" id="prevStep" onclick="whatNext(0)" class="control-button btn">Previous Step</button>
                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="control-button btn">Save and Exit</button>
                <button type="submit" id="saveAndCont" onclick="whatNext(6)" class="control-button btn">Save and Continue</button>
            </div>

        </form>
    </main>
    <?php include("../inc/scripts.php") ?>
    <script>
        $(document).ready(function() {

            $("#appForm").on("submit", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                save(data);
            });

        });
    </script>
</body>

</html>