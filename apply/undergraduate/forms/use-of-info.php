<?php

require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal = $user->fetchApplicantPersI($user_id);
require_once('../../inc/page-data.php');

?>

<fieldset class="fieldset">
    <legend>Use of Information Agreement</legend>
</fieldset>