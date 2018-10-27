<?php
namespace app\models;

use app\services\Db;

abstract class DataModel implements IModel
{
    private $db;

    public function __construct(){
        $this->db = static::getDb();
    }

    public function getOne($id){
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return static::getDb()->queryObject($sql, [':id' => $id], get_called_class());
    }

    public function getAll(){
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        return static::getDb()->queryAll($sql);
    }

    public function delete($id){
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        return static::getDb()->execute($sql, [':id' => $id]);
    }

    public function save(){
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    static function GetDb(){
        return Db::getInstance();
    }

    public function insert(){
        $columns = [];
        $params = [];
        $table = $this->getTableName();
        foreach($this as $key => $value){
            if($key == 'db'){
                continue;
            }
            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }
        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));
        $sql = "INSERT INTO  `{$table}` ({$columns}) VALUES ({$placeholders})";
        static::getDb()->execute($sql,$params);
        $this->id = static::getDb()->lastInsertId();
    }

    public function update(){
        $columns = [];
        $params = [];
        $table = $this->getTableName();
        foreach($this as $key => $value){
            if($key == 'db'){
                continue;
            }
            $params["{$key} = :{$key}"] = $value;
            $columns[":{$key}"] = $value;
        }
        $placeholders = implode(", ", array_keys($params));
        $sql = "UPDATE {$table} SET {$placeholders} WHERE (id = {$this->id});";
        static::getDb()->execute($sql, $columns);

    }
}
