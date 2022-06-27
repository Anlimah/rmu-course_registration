<?php

namespace Src\Controller;

require_once('../bootstrap.php');

use Src\System\DatabaseMethods;

class ExposeDataController extends DatabaseMethods
{
    public function getFormTypes()
    {
        return $this->getData("SELECT * FROM `form_type`");
    }

    public function getPrograms()
    {
        return $this->getData("SELECT * FROM `programs`");
    }

    public function getHalls()
    {
        return $this->getData("SELECT * FROM `halls`");
    }
}
