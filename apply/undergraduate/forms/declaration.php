<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal = $user->fetchApplicantPersI($user_id);

?>

<fieldset class="fieldset">

</fieldset>