<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal = $user->fetchApplicantPersI($user_id);
$appStatus = $user->getApplicationStatus($user_id);
$fullname = !empty($personal[0]["middle_name"]) ? $personal[0]["first_name"] . " " . $personal[0]["middle_name"] . " " . $personal[0]["last_name"] : $personal[0]["first_name"] . " " . $personal[0]["last_name"];
?>

<fieldset class="fieldset row">
    <div class="mb-4" style="width: 100% !important;">
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Attention! Attention! Attention!</h4>
            <p>Please note the following:</p>
            <ul style="list-style:disc;">
                <li>Make sure to click the button <b><em>check my work and continue</em></b> at the bottom of each page to ensure all required data have been provided</li>
                <li>Before submitting your application, go over to make sure all provided data is accurate.</li>
                <li>Note that you can't come back to this section of your application process after submission</li>
            </ul>
        </div>
    </div>

    <div class="alert alert-default" role="alert">
        <div style="width: 100%; border: 1px dashed red;padding: 20px; background-color:#ffffcc;">
            <div>
                <label for="" style="color: red;">IMPORTANT</label>
            </div>
            <p>
                AN APPLICANT WHO MAKES A FALSE STATEMENT OR WITHHOLDS RELEVANT INFORMATION MAY BE REFUSED ADMISSION. IF HE/SHE HAS ALREADY BEEN ADMITTED INTO THE UNIVERSITY, HE/SHE WILL BE WITHDRAWN.
            </p>
            <div style="width: 100%; background-color: #036; color: #fff; font-size: smaller; padding: 5px 10px">
                <b>DECLARATION</b>
            </div>
            <div style="align-items:center; margin-top: 10px">
                <p style="margin-left: 10px;">I <label for=""><?= $fullname ?></label>, certify that the information provided above is valid and will be held personally responsible for its authenticity and will bear any consequences for any invalid information provided.</p>

                <div class="form-check">
                    <label class="form-check-label" for="accept-declared">
                        <input style="background-color: none !important;" class="form-check-input" type="checkbox" value="" id="accept-declared" required>Agree
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>

                <div style="width: 100%; text-align:center">
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px !important; background-color: #036; padding: 15px 20px !important">Submit Application</button>
                </div>
            </div>
        </div>
    </div>
</fieldset>