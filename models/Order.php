<?php
namespace app\models;

Class Order extends DataModel{
  public $id;
  public $tov_id;
  public $tov_kol;
  public $buyer_id;
  public $status;
  


  public function getTableName(){
    return 'orders'; 
  }



}
