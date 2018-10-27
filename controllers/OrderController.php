<?php
namespace app\controllers;

class OrderController extends Controller{

  protected $action;
  protected $defaultAction = "index";
  protected $layout = "main";
  protected $useLayout = true;

  public function actionIndex(){
    echo "order";
  }

  public function actionView(){
    $this->useLayout = false;
    $id = $_GET['id'];
    $model = new \app\models\Order();
    $model = $model->getOne($id);
    echo $this->render("order", ['model' => $model]);
  }

}
