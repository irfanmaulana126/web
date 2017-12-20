<?php
 
namespace common\classes;
 
class DbCache extends \yii\caching\DbCache
{
 
    public function init()
    {
        parent::init();
        $this->createTable();
    }
 
    protected function createTable()
    {
        if ($this->db->schema->getTableSchema($this->cacheTable) === null) {
            $cmd = $this->db->createCommand();
            $cmd->createTable($this->cacheTable, [
                'id' => 'CHAR(128) PRIMARY KEY',
                'expire' => 'integer',
                'data' => 'binary',
            ])->execute();
        }
    }
}