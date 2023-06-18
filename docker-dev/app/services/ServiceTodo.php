<?php
require_once(dirname(__FILE__). "/../models/Todo.php");
require_once( dirname(__DIR__). "/controllers/BaseController.php" );


class ServiceTodo  {

  public function paginate( $params )
  {

	
	$page = BaseController::getCurrentPage();
	$range = Todo::pagenum( $page );
	$todos = Todo::findAll();
	$result = "";

	$query = [];

	if( $params ){
		$query = self::buildQuery( $params );
		$todo = new Todo;
		$result = $todo->findByQuery( $query[0], $query[1] );
	}

    return [
      'page' => $page,
      'range' => $range,
      'todos' => $todos,
	  'result' => $result
    ];


  }

  public function store($data)
	{
		
		$result = Todo::insert($data);

		if ($result === true) {

			return true;

		} else {

			return false;
		}

	}

  public function update() {

		$todo = new Todo;
		$result = $todo->update($validated_data,$params);

		if ($result === true) {

			return true;

		} else {

			return false;

		}

	}

	private function buildQuery( $params ) {

		$query = "SELECT * FROM todos WHERE ";
		$queries = [];

		foreach( $params as $key => $value ) {
			$query .= $key . "= :" . $key . " OR ";
			$queries[] = [
				'value' => $value,
				'type' => PDO::PARAM_STR,
				'param' => ':' . $key,
			];
		};
		$query = rtrim( $query, " OR ");

		return [$queries, $query];

	}
	








}
?>