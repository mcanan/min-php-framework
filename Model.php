<?php
namespace mcanan\framework;

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

    public function startTransaction()
    {
        return $this->db->update("start transaction");
    }
    
    public function commit()
    {
        return $this->db->update("commit");
    }
    
    public function rollback()
    {
        return $this->db->update("rollback");
    }
}
