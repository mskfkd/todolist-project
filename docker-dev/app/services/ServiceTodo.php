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
		$queries = [];

		foreach( $params as $key => $value ) {
			$query .= $key . "= :" . $key . " OR ";
			$queries[] = [
				'value' => $value,
				'type' => PDO::PARAM_STR,
			];
		};
		$query = rtrim( $query, " OR ");
		$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		$sth = $db->prepare($query);
		foreach( $queries as $key => $param) {
			$sth->bindValue( $key + 1, $param[ 'value' ], $param['type']);
		}

		return $sth;

	}
	








}
?>