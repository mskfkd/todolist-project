<?php


class ServiceTodo {

  public function paginate()
  {
    $page = parent::getCurrentPage();
		$range = Todo::pagenum( $page );
		$todos = Todo::findAll();

    return [
      $page, $range, $todos
    ];


  }















}
?>