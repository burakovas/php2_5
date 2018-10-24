<?php
namespace app\models;

use app\services\Db;

abstract class DataModel implements IModel
{
    private $db;

    public function __construct(){
        $this->db = Db::getInstance();
    }

    public function getOne($id){
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return $this->db->queryObject($sql, [':id' => $id], get_called_class());
    }

    public function getAll(){
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        return $this->db->queryAll($sql);
    }

    public function delete($id){
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }

    public function save(){
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
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
        $this->db->execute($sql,$params);
        $this->id = $this->db->lastInsertId();
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
        $this->db->execute($sql, $columns);

    }
}
