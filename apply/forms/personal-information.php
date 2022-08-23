<?php

use Src\Controller\UsersController;

require_once('../src/Controller/UsersController.php');

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
                        <input class="disability" style="margin-left: 20px;" type="radio" name="disability" id="disability-yes" value="yes" <?= $personal[0]["disability"] == 1 ? "checked" : "" ?>> Yes
                    </label>
                    <label class="form-check-label" for="disability-no">
                        <input class="disability" style="margin-left: 20px;" type="radio" name="disability" id="disability-no" value="no" <?= $personal[0]["disability"] == 0 ? "checked" : "" ?>> No
                    </label>
                </div>
                <div class="mb-4 yes-disability" id="disability-list">
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
                <input class="english-native" style="margin-left: 20px;" type="radio" name="english-native" id="english-native-yes" value="Yes" <?= $personal[0]["english_native"] == 1 ? "checked" : "" ?>> Yes
            </label>
            <label for="english-native-no">
                <input class="english-native" style="margin-left: 20px;" type="radio" name="english-native" id="english-native-no" value="No" <?= $personal[0]["english_native"] == 0 ? "checked" : "" ?>> No
            </label>
        </div>

        <div class="mb-4 not-english-native" id="english-native-list">
            <label class="form-label" for="english-native">Do you understand and speak some english? <span class="input-required">*</span></label>
            <label for="english-native-yes">
                <input style="margin-left: 20px;" type="radio" name="und-speak-english" id="und-speak-english-yes" value="Yes" <?= $personal[0]["english_native"] == 1 ? "checked" : "" ?>> Yes
            </label>
            <label for="english-native-no">
                <input style="margin-left: 20px;" type="radio" name="und-speak-english" id="und-speak-english-no" value="No" <?= $personal[0]["english_native"] == 0 ? "checked" : "" ?>> No
            </label>
            <div class="mb-4">
                <label class="form-label" for="language-spoken">Speicfy Language</label>
                <select class="form-select form-select-sm mb-3" name="language-spoken" id="language-spoken">
                    <option value="" hidden>Select</option>
                </select>
            </div>
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
            <div style="max-width: 280px !important; display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                <select class="form-select form-select-sm" name="gd-country" id="gd-country" style="margin-right: 10px; width: 35%">
                    <option value="" hidden>Select</option>
                    <option value="Single" selected>+233</option>
                    <option value="Married">+234</option>
                    <option value="Divorced">+235</option>
                    <option value="Widowed">+236</option>
                    <option value="Separarted">+237</option>
                </select>
                <input class="form-control form-select-sm" style="width: 65%" type="text" name="app-phone-number" id="app-phone-number" value="<?= $personal[0]["phone_no1"] ?>">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label" for="app-other-number"> Other Phone Number <span>(Optional)</span></label>
            <div style="max-width: 280px !important; display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                <select class="form-select form-select-sm" name="gd-country" id="gd-country" style="margin-right: 10px; width: 35%">
                    <option value="" hidden>Select</option>
                    <option value="Single" selected>+233</option>
                    <option value="Married">+234</option>
                    <option value="Divorced">+235</option>
                    <option value="Widowed">+236</option>
                    <option value="Separarted">+237</option>
                </select>
                <input class="form-control form-select-sm" style="width: 65%" type="text" name="app-other-number" id="app-other-number" value="<?= $personal[0]["phone_no2"] ?>">
            </div>
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
            <div style="max-width: 280px !important; display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                <select class="form-select form-select-sm" name="gd-country" id="gd-country" style="margin-right: 10px; width: 35%">
                    <option value="" hidden>Select</option>
                    <option value="Single" selected>+233</option>
                    <option value="Married">+234</option>
                    <option value="Divorced">+235</option>
                    <option value="Widowed">+236</option>
                    <option value="Separarted">+237</option>
                </select>
                <input class="form-control form-select-sm" style="width: 65%" type="tel" name="gd-phone-number" id="phone-number" value="<?= $personal[0]["p_phone_no"] ?>">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label" for="gd-email-address">Email Address</label>
            <input class="form-control" type="email" name="gd-email-address" id="gd-email-address" value="<?= $personal[0]["p_email_addr"] ?>">
        </div>
    </fieldset>

</form>