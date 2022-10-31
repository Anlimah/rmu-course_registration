<?php

require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$photo = $user->fetchApplicantPhoto($user_id);
$personal = $user->fetchApplicantPersI($user_id);
$appStatus = $user->getApplicationStatus($user_id);
require_once('../../inc/page-data.php');

?>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Passport Picture</legend>
    </div>
    <div class="field-content" style="display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
        <div style="margin-right: 15px;">
            <p>Please upload a passport size photo of yourself. The size of the image should not be more than 100KB. The background color of your image should be white.</p>
            <p style="color: brown"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>

            <label for="photo-upload" class="upload-photo-label btn btn-primary">Upload photo</label>

        </div>
        <div class="photo-display" style="padding: 5px;">
            <img id="app-photo" src="../photos/<?= !empty($photo[0]["photo"]) ? $photo[0]["photo"] : "icons8-test-account-48.png" ?>" alt="" style="width: 100%;">
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Legal Name</legend>
    </div>
    <div class="field-content">
        <p style="margin-bottom: 30px !important">Please use your legal name. DO NOT use nicknames or abbreviations</p>
        <div class="form-fields" style="flex-grow: 8;">
            <div class="mb-4">
                <label class="form-label" for="prefix">Prefix <span class="input-required">*</span></label>
                <select required class="form-select form-select-sm mb-3" name="prefix" id="prefix">
                    <option value="" hidden>Select</option>
                    <option value="Mr." <?= $personal[0]["prefix"] == strtoupper("Mr.") ? "selected" : "" ?>>Mr.</option>
                    <option value="Mrs." <?= $personal[0]["prefix"] == strtoupper("Mrs.") ? "selected" : "" ?>>Mrs.</option>
                    <option value="Ms." <?= $personal[0]["prefix"] == strtoupper("Ms.") ? "selected" : "" ?>>Ms.</option>
                    <option value="Prof. Dr." <?= $personal[0]["prefix"] == strtoupper("Prof. Dr.") ? "selected" : "" ?>>Prof. Dr.</option>
                    <option value="Prof." <?= $personal[0]["prefix"] == strtoupper("Prof.") ? "selected" : "" ?>>Prof.</option>
                    <option value="Rev." <?= $personal[0]["prefix"] == strtoupper("Rev.") ? "selected" : "" ?>>Rev.</option>
                    <option value="Rev. Dr." <?= $personal[0]["prefix"] == strtoupper("Rev. Dr.") ? "selected" : "" ?>>Rev. Dr.</option>
                    <option value="Rev. Sis." <?= $personal[0]["prefix"] == strtoupper("Rev. Sis.") ? "selected" : "" ?>>Rev. Sis.</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label" for="first-name">First Name <span class="input-required">*</span></label>
                <input required class="form-control" type="text" name="first-name" id="first-name" value="<?= $personal[0]["first_name"] ?>">
            </div>
            <div class="mb-4">
                <label class="form-label" for="middle-name">Middle Name</label>
                <input class="form-control" type="text" name="middle-name" id="middle-names" value="<?= $personal[0]["middle_name"] ?>">
            </div>
            <div class="mb-4">
                <label class="form-label" for="last-name">Surname<span class="input-required">*</span></label>
                <input required class="form-control" type="text" name="last-name" id="last-name" value="<?= $personal[0]["last_name"] ?>">
            </div>
            <div class="mb-4">
                <label class="form-label" for="suffix">Suffix</label>
                <select class="form-select form-select-sm mb-3" name="suffix" id="suffix">
                    <option value="" hidden>Select</option>
                    <option value="Jr." <?= $personal[0]["suffix"] == strtoupper("Jr.") ? "selected" : "" ?>>Jr.</option>
                    <option value="Sr." <?= $personal[0]["suffix"] == strtoupper("Sr.") ? "selected" : "" ?>>Sr.</option>
                    <option value="I" <?= $personal[0]["suffix"] == strtoupper("I") ? "selected" : "" ?>>I</option>
                    <option value="II" <?= $personal[0]["suffix"] == strtoupper("II") ? "selected" : "" ?>>II</option>
                    <option value="III" <?= $personal[0]["suffix"] == strtoupper("III") ? "selected" : "" ?>>III</option>
                    <option value="IV" <?= $personal[0]["suffix"] == strtoupper("IV") ? "selected" : "" ?>>IV</option>
                    <option value="V" <?= $personal[0]["suffix"] == strtoupper("V") ? "selected" : "" ?>>V</option>
                    <option value="J.D." <?= $personal[0]["suffix"] == strtoupper("J.D.") ? "selected" : "" ?>>J.D.</option>
                    <option value="Esq" <?= $personal[0]["suffix"] == strtoupper("Esq") ? "selected" : "" ?>>Esq</option>
                    <option value="M.D." <?= $personal[0]["suffix"] == strtoupper("M.D.") ? "selected" : "" ?>>M.D.</option>
                    <option value="O.F.M." <?= $personal[0]["suffix"] == strtoupper("O.F.M.") ? "selected" : "" ?>>O.F.M.</option>
                    <option value="O.P." <?= $personal[0]["suffix"] == strtoupper("O.P.") ? "selected" : "" ?>>O.P.</option>
                    <option value="Ph.D." <?= $personal[0]["suffix"] == strtoupper("Ph.D.") ? "selected" : "" ?>>Ph.D.</option>
                    <option value="S.J." <?= $personal[0]["suffix"] == strtoupper("S.J.") ? "selected" : "" ?>>S.J.</option>
                </select>
            </div>
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Personal Details</legend>
    </div>
    <div class="field-content">
        <div class="form-fields" style="flex-grow: 8;">
            <div class="mb-4">
                <label class="form-label" for="gender">Gender <span class="input-required">*</span></label>
                <select required class="form-select form-select-sm mb-3" name="gender" id="gender">
                    <option value="" hidden>Select</option>
                    <option value="Male" <?= $personal[0]["gender"] == strtoupper("Male") ? "selected" : "" ?>>Male</option>
                    <option value="Female" <?= $personal[0]["gender"] == strtoupper("Female") ? "selected" : "" ?>>Female</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label" for="dob">Date of Birth <span class="input-required">*</span></label>
                <input required class="form-control" type="date" name="dob" id="dob" value="<?= $personal[0]["dob"] ?>">
            </div>
            <div class="mb-4">
                <label class="form-label" for="marital-status">Marital Status <span class="input-required">*</span></label>
                <select required class="form-select form-select-sm mb-3" name="marital-status" id="marital-status">
                    <option value="" hidden>Select</option>
                    <option value="Single" <?= $personal[0]["marital_status"] == strtoupper("Single") ? "selected" : "" ?>>Single</option>
                    <option value="Married" <?= $personal[0]["marital_status"] == strtoupper("Married") ? "selected" : "" ?>>Married</option>
                    <option value="Divorced" <?= $personal[0]["marital_status"] == strtoupper("Divorced") ? "selected" : "" ?>>Divorced</option>
                    <option value="Widowed" <?= $personal[0]["marital_status"] == strtoupper("Widowed") ? "selected" : "" ?>>Widowed</option>
                    <option value="Separarted" <?= $personal[0]["marital_status"] == strtoupper("Separarted") ? "selected" : "" ?>>Separated</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label" for="nationality">Nationality <span class="input-required">*</span></label>
                <input required class="form-control form-control-sm mb-3" list="nationality-list" name="nationality" id="nationality" value="<?= $personal[0]["nationality"] ?>">
                <datalist id="nationality-list">
                    <?php
                    foreach (COUNTRIES as $cn) {
                        echo '<option value="' . $cn["name"] . '">';
                    }
                    ?>
                </datalist>
            </div>
            <div class="mb-4">
                <label class="form-label" for="country-res">Country of Residence <span class="input-required">*</span></label>
                <input required class="form-control form-control-sm mb-3" list="country-res-list" name="country-res" id="country-res" value="<?= $personal[0]["country_res"] ?>">
                <datalist id="country-res-list">
                    <?php
                    foreach (COUNTRIES as $cn) {
                        echo '<option value="' . $cn["name"] . '">';
                    }
                    ?>
                </datalist>
            </div>
            <div class="mb-4">
                <label class="form-label">Any Disability <span class="input-required">*</span></label>
                <label class="form-label radio-btn" for="disability-yes">
                    <input required class="disability form-radio" style="margin: 0 !important; padding: 0 !important;" type="radio" name="disability" id="disability-yes" value="yes" <?= $personal[0]["disability"] == 1 ? "checked" : "" ?>> Yes
                </label>
                <label class="form-label radio-btn" for="disability-no">
                    <input required class="disability form-radio" style="margin: 0 !important; padding: 0 !important;" type="radio" name="disability" id="disability-no" value="no" <?= $personal[0]["disability"] == 0 ? "checked" : "" ?>> No
                </label>
            </div>
            <div class="mb-4 <?= $personal[0]["disability"] == 1 ? "" : "hide" ?>" id="disability-list">
                <label class="form-label" for="disability">Select Disability <span class="input-required">*</span></label>
                <select class="form-select form-select-sm mb-3" name="disability-descript" id="disability-descript">
                    <option value="" hidden>Select</option>
                </select>
            </div>
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Place of Birth</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <label for="country-birth" class="form-label">Country of Birth <span class="input-required">*</span></label>
            <input required class="form-control form-control-sm mb-3" list="country-birth-list" name="country-birth" id="country-birth" value="<?= $personal[0]["country_birth"] ?>">
            <datalist id="country-birth-list">
                <?php
                foreach (COUNTRIES as $cn) {
                    echo '<option value="' . $cn["name"] . '">';
                }
                ?>
            </datalist>
        </div>
        <div class="mb-4">
            <label class="form-label" for="region-birth">State / Province / Region</label>
            <input class="form-control form-control-sm mb-3" list="region-birth-list" name="region-birth" id="country-birth" value="<?= $personal[0]["spr_birth"] ?>">
            <datalist id="region-birth-list">
                <?php
                foreach (COUNTRIES as $cn) {
                    echo '<option value="' . $cn["name"] . '">';
                }
                ?>
            </datalist>
        </div>
        <div class="mb-4">
            <label class="form-label" for="home-town">City of birth <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="home-town" id="home-town" value="<?= $personal[0]["city_birth"] ?>">
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Language</legend>
    </div>
    <div class="field-content">
        <div class="mb-3">
            <label class="form-label" for="english-native">English Native <span class="input-required">*</span></label>
            <label class="form-label radio-btn" for="english-native-yes">
                <input required class="english-native form-radio" style="margin: 0 !important; padding: 0 !important;" type="radio" name="english-native" id="english-native-yes" value="yes" <?= $personal[0]["english_native"] == 1 ? "checked" : "" ?>> Yes
            </label>
            <label class="form-label radio-btn" for="english-native-no">
                <input required class="english-native form-radio" style="margin: 0 !important; padding: 0 !important;" type="radio" name="english-native" id="english-native-no" value="no" <?= $personal[0]["english_native"] == 0 ? "checked" : "" ?>> No
            </label>
        </div>

        <div class="mt-3 <?= $personal[0]["english_native"] == 1 ? "hide" : "" ?>" id="english-native-list">
            <label class="form-label">Do you understand and speak some english? <span class="input-required">*</span></label>
            <label for="speak-some-eng-yes" class="form-label radio-btn">
                <input class="english-native" style="margin: 0 !important; padding: 0 !important;" type="radio" name="speak-some-eng" id="speak-some-eng-yes" value="Yes" <?= $personal[0]["english_native"] == 1 ? "checked" : "" ?>> Yes
            </label>
            <label for="speak-some-eng-no" class="form-label radio-btn">
                <input class="english-native" style="margin: 0 !important; padding: 0 !important;" type="radio" name="speak-some-eng" id="speak-some-eng-no" value="No" <?= $personal[0]["english_native"] == 0 ? "checked" : "" ?>> No
            </label>
            <div class="mt-3">
                <label class="form-label" for="language-spoken">Speicfy Language</label>
                <select class="form-select form-select-sm mb-3" name="language-spoken" id="language-spoken">
                    <option value="" hidden>Select</option>
                    <option value="Arabic" <?= $personal[0]["other_language"] == strtoupper("Arabic") ? "selected" : "" ?>>Arabic</option>
                    <option value="Bengali" <?= $personal[0]["other_language"] == strtoupper("Bengali") ? "selected" : "" ?>>Bengali</option>
                    <option value="French" <?= $personal[0]["other_language"] == strtoupper("French") ? "selected" : "" ?>>French</option>
                    <option value="Hindi" <?= $personal[0]["other_language"] == strtoupper("Hindi") ? "selected" : "" ?>>Hindi</option>
                    <option value="Indonesian" <?= $personal[0]["other_language"] == strtoupper("Indonesian") ? "selected" : "" ?>>Indonesian</option>
                    <option value="Mandarin" <?= $personal[0]["other_language"] == strtoupper("Mandarin") ? "selected" : "" ?>>Mandarin</option>
                    <option value="Portuguese" <?= $personal[0]["other_language"] == strtoupper("Portuguese") ? "selected" : "" ?>>Portuguese</option>
                    <option value="Russian" <?= $personal[0]["other_language"] == strtoupper("Russian") ? "selected" : "" ?>>Russian</option>
                    <option value="Spanish" <?= $personal[0]["other_language"] == strtoupper("Spanish") ? "selected" : "" ?>>Spanish</option>
                </select>
            </div>
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Address</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <label class="form-label" for="address-line1">Address Line 1 <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="address-line1" id="address-line1" value="<?= $personal[0]["postal_addr"] ?>">
        </div>
        <div class="mb-4">
            <label class="form-label" for="address-line2">Address Line 2</label>
            <input class="form-control" type="text" name="address-line2" id="address-line2" value="<?= $personal[0]["postal_addr"] ?>">
        </div>
        <div class="mb-4">
            <label class="form-label" for="address-country">Country <span class="input-required">*</span></label>
            <input required class="form-control form-control-sm mb-3" list="address-country-list" name="address-country" id="address-country" value="<?= $personal[0]["postal_country"] ?>">
            <datalist id="address-country-list">
                <?php
                foreach (COUNTRIES as $cn) {
                    echo '<option value="' . $cn["name"] . '">';
                }
                ?>
            </datalist>
        </div>
        <div class="mb-4">
            <label class="form-label" for="address-region">State / Privince / Region <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="address-region" id="address-region" value="<?= $personal[0]["postal_spr"] ?>">
        </div>
        <div class="mb-4">
            <label class="form-label" for="address-town">City <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="address-town" id="address-town" value="<?= $personal[0]["postal_town"] ?>">
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Contact</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <label class="form-label" for="app-phone-number">Primary Phone Number <span class="input-required">*</span></label>
            <div style="max-width: 280px !important; display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                <select required class="form-select form-select-sm  country-code" name="phone-number1-code" id="app-phone-number-code" style="margin-right: 10px; width: 45%">
                    <option value="" hidden>Select</option>
                    <?php
                    foreach (COUNTRIES as $cn) {
                    ?>
                        <option value="<?= $cn["code"] ?>" <?= $personal[0]["phone_no1_code"] == $cn["code"] ? "selected" : "" ?>><?= $cn["name"] . " " . ($cn["code"]) ?></option>';

                    <?php
                    }
                    ?>
                </select>
                <input required class="form-control form-control-sm" style="width: 70%" type="text" name="phone-number1" id="app-phone-number" value="<?= $personal[0]["phone_no1"] ?>">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label" for="app-other-number"> Other Phone Number</label>
            <div style="max-width: 280px !important; display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                <select class="form-select form-select-sm  country-code" name="other-number-code" id="app-other-number-code" style="margin-right: 10px; width: 45%">
                    <option value="" hidden>Select</option>
                    <?php
                    foreach (COUNTRIES as $cn) {
                    ?>
                        <option value="<?= $cn["code"] ?>" <?= $personal[0]["phone_no2_code"] == $cn["code"] ? "selected" : "" ?>><?= $cn["name"] . " " . ($cn["code"]) ?></option>';
                    <?php
                    }
                    ?>
                </select>
                <input class="form-control form-control-sm" style="width: 70%" type="text" name="other-number" id="app-other-number" value="<?= $personal[0]["phone_no2"] ?>">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label" for="app-email-address">Email Address <span class="input-required">*</span></label>
            <input required class="form-control" type="email" name="app-email-address" id="app-email-address" value="<?= $personal[0]["email_addr"] ?>">
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Parent / Guardian Information</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <label class="form-label" for="gd-prefix">Prefix <span class="input-required">*</span></label>
            <select required class="form-select form-select-sm mb-3" name="gd-prefix" id="gd-prefix">
                <option value="" hidden>Select</option>
                <option value="Mr." <?= $personal[0]["prefix"] == strtoupper("Mr.") ? "selected" : "" ?>>Mr.</option>
                <option value="Mrs." <?= $personal[0]["prefix"] == strtoupper("Mrs.") ? "selected" : "" ?>>Mrs.</option>
                <option value="Ms." <?= $personal[0]["prefix"] == strtoupper("Ms.") ? "selected" : "" ?>>Ms.</option>
                <option value="Prof. Dr." <?= $personal[0]["prefix"] == strtoupper("Prof. Dr.") ? "selected" : "" ?>>Prof. Dr.</option>
                <option value="Prof." <?= $personal[0]["prefix"] == strtoupper("Prof.") ? "selected" : "" ?>>Prof.</option>
                <option value="Rev." <?= $personal[0]["prefix"] == strtoupper("Rev.") ? "selected" : "" ?>>Rev.</option>
                <option value="Rev. Dr." <?= $personal[0]["prefix"] == strtoupper("Rev. Dr.") ? "selected" : "" ?>>Rev. Dr.</option>
                <option value="Rev. Sis." <?= $personal[0]["prefix"] == strtoupper("Rev. Sis.") ? "selected" : "" ?>>Rev. Sis.</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="gd-surname">Surname <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="gd-surname" id="gd-surname" value="<?= $personal[0]["p_last_name"] ?>">
        </div>
        <div class="mb-4">
            <label class="form-label" for="gd-first-name">First Name <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="gd-first-name" id="gd-first-name" value="<?= $personal[0]["p_first_name"] ?>">
        </div>
        <div class="mb-4">
            <label class="form-label" for="gd-occupation">Occupation <span class="input-required">*</span></label>
            <input required class="form-control" type="text" name="gd-occupation" id="gd-occupation" value="<?= $personal[0]["p_occupation"] ?>">
        </div>
        <div class="mb-4">
            <label class="form-label" for="gd-phone-number">Phone Number <span class="input-required">*</span></label>
            <div style="max-width: 280px !important; display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                <select required class="form-select form-select-sm country-code" name="gd-phone-number-code" id="gd-phone-number-code" style="margin-right: 10px; width: 45%">
                    <option value="" hidden>Select</option>
                    <?php
                    foreach (COUNTRIES as $cn) {
                    ?>
                        <option value="<?= $cn["code"] ?>" <?= $personal[0]["p_phone_no_code"] == $cn["code"] ? "selected" : "" ?>><?= $cn["name"] . " " . ($cn["code"]) ?></option>';

                    <?php
                    }
                    ?>
                </select>
                <input required class="form-control form-select-sm" style="width: 70%" type="tel" name="gd-phone-number" id="gd-phone-number" value="<?= $personal[0]["p_phone_no"] ?>">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label" for="gd-email-address">Email Address</label>
            <input class="form-control" type="email" name="gd-email-address" id="gd-email-address" value="<?= $personal[0]["p_email_addr"] ?>">
        </div>
    </div>
</fieldset>