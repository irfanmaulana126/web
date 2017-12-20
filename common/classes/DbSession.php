<?php
 
namespace common\classes;
 
class DbSession extends \yii\web\DbSession
{
 
    public function init()
    {
        parent::init();
        $this->createTable();
    }
 
    protected function createTable()
    {
        if ($this->db->schema->getTableSchema($this->sessionTable) === null) {
            $cmd = $this->db->createCommand();
            $cmd->createTable($this->sessionTable, [
                'id' => 'CHAR(40) PRIMARY KEY',
                'expire' => 'integer',
                'data' => 'binary',
            ])->execute();
        }
    }
}