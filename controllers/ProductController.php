<?php
namespace app\controllers;

class ProductController{

  private $action;
  private $defaultAction = "index";
  private $layout = "main";
  private $useLayout = true;

  public function run($action = null){
    $this->action = $action ?: $this->defaultAction;
    $method = "action" . ucfirst($this->action);
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      echo "404";
      }
  }


  public function actionIndex(){
    echo "catalog";
  }

  public function actionCart(){

    $id = $_GET['id'];
    $model = new \app\models\Product();
    $model = $model->getOne($id);

    echo $this->render("card", ['model' => $model]);
    
  }

  public function render($template, $params = []){
    if($this->useLayout){
      $content = $this->renderTemplate($template, $params);
      return $this->renderTemplate("layouts/$this->layout",['content' => $content]);
    }

    return $this->renderTemplate($template, $params);
  }

  public function renderTemplate($template, $params = []){
    ob_start();
    extract($params);
    include TEMPLATES_DIR . $template . ".php";
    return ob_get_clean();
  }


}
