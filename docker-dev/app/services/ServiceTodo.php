<?php
require_once(dirname(__FILE__). "/../models/Todo.php");
require_once( dirname(__DIR__). "/controllers/BaseController.php" );


class ServiceTodo  {

  public function paginate( $params )
  {

	
	$page = BaseController::getCurrentPage();
	$range = Todo::pagenum( $page );
	$todos = Todo::findAll();

	if( $params ){
		$query = self::buildQuery( $params );
		$todo = new Todo;
		$result = $todo->findByQuery( $params, $query );
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


		foreach( $params as $key => $data ) {
			$query .= $sth->bindParam( ":".$key, $data, PDO::PARAM_STR);

		}

		return $query;

	}
	








}
?>