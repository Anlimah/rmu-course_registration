<?php
require_once('../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal = $user->fetchApplicantPersI($user_id);

?>
<form id="appForm" method="POST" style="margin-top: 50px !important;">
</form>