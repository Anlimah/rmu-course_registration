<?php

namespace Src\Controller;

require_once('../bootstrap.php');

use Twilio\Rest\Client;

use Src\System\DatabaseMethods;

class AdminController
{
    private $db;
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->dm = new DatabaseMethods();
        $this->username = $username;
        $this->password = $password;
    }
}
