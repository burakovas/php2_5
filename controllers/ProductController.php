<?php
namespace app\controllers;

class ProductController extends Controller{

  protected $action;
  protected $defaultAction = "index";
  protected $layout = "main";
  protected $useLayout = true;

  public function actionIndex(){
    echo "catalog";
  }

  public function actionCart(){
    $this->useLayout = false;
    $id = $_GET['id'];
    $model = new \app\models\Product();
    $model = $model->getOne($id);
    echo $this->render("card", ['model' => $model]);
  }


}
