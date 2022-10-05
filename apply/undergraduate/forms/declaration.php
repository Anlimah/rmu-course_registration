<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal = $user->fetchApplicantPersI($user_id);

?>

<fieldset class="fieldset">
    <div style="width: 100%; border: 1px dashed red;padding: 20px; background-color:#ffffcc;">
        <div>
            <label for="" style="color: red;">IMPORTANT</label>
        </div>
        <p>
            AN APPLICANT WHO MAKES A FALSE STATEMENT OR WITHHOLDS RELEVANT INFORMATION MAY BE REFUSED ADMISSION. IF HE HAS ALREADY COME INTO THE UNIVERSITY, HE WILL BE WITHDRAWN.
        </p>
        <div style="width: 100%; background-color: #036; color: #fff; font-size: smaller; padding: 5px 10px">
            <b>DECLARATION</b>
        </div>
        <form id="declaration-form">
            <div style="display: flex; flex-direction: row; align-items:center; margin-top: 10px">
                <input type="checkbox" name="declaration" id="declaration" style="margin-top: 5px;">
                <p style="margin-left: 10px;">I <label for="">Francis Anlimah</label> GNT TYYT certify that the information provided above is valid and will be held personally responsible for its authenticity and will bear any consequences for any invalid information provided.</p>
            </div>
            <input type="submit" class="btn btn-primary" value="Certify" style="margin: 0 45%; margin-top: 20px !important">
        </form>
    </div>
</fieldset>