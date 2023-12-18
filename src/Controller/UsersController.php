<?php

namespace Src\Controller;

use Src\Controller\ExposeDataController;
use Src\System\DatabaseConnector;

class UsersController
{
    private $dm;
    private $expose;

    public function __construct($host, $port, $db, $user, $pass)
    {
        $this->dm = new DatabaseConnector($host, $port, $db, $user, $pass);
        $this->expose = new ExposeDataController();
    }

    public function verifyLoginDetails($app_number, $pin)
    {
        $sql = "SELECT al.`pin`, al.`id`, al.`purchase_id`, fc.`declaration`, pd.`form_id` 
                FROM `applicants_login` AS al, `form_sections_chek` AS fc, `purchase_detail` AS pd 
                WHERE al.`app_number` = :a AND pd.id = al.`purchase_id` AND fc.app_login = al.id;";
        $data = $this->dm->runQuery($sql, array(':a' => sha1($app_number)));

        if (empty($data)) return 0;

        if (password_verify($pin, $data[0]["pin"]))
            return array("id" => $data[0]["id"], "type" => $data[0]["form_id"], "submitted" => $data[0]["declaration"]);

        return 0;
    }

    
}
