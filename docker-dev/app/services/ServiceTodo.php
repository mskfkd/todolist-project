<?php
require_once(dirname(__FILE__). "/../models/Todo.php");
require_once( dirname(__DIR__). "/controllers/BaseController.php" );


class ServiceTodo  {

  public function paginate()
  {
    $page = BaseController::getCurrentPage();
		$range = Todo::pagenum( $page );
		$todos = Todo::findAll();

    return [
      'page' => $page,
      'range' => $range,
      'todos' => $todos
    ];


  }















}
?>