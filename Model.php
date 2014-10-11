<?php
require_once 'Base.php';
require_once 'Db2.php';

/**
* Abstract base class for a model entity
*/
abstract class Model extends Base
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}
