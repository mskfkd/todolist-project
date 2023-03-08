<?php
require_once(dirname(__FILE__). "/../models/Todo.php");
require_once( dirname(__DIR__). "/controllers/BaseController.php" );


class ServiceTodo  {

  public function paginate( $params )
  {
	if( isset($params) ){
		$this->buildQuery( $params );
	}
    $page = BaseController::getCurrentPage();
    $range = Todo::pagenum( $page );
    $todos = Todo::findAll();

    return [
      'page' => $page,
      'range' => $range,
      'todos' => $todos
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
		$query = 'where';


		if( isset( $params[ 'title' ] ) ) {
			
			$query .= "title =" . $params[ 'title' ];

		} elseif ( isset( $params[ 'deadline1' ] )
				|| isset( $params[ 'deadline2' ]) ) {

			$query .= "deadline1 =" . $params[ 'deadline1' ] . "&deadline2 =" . $params[ 'deadline2' ];

		}elseif( isset( $params[ 'selectstatus' ] ) ) {

			$query .= "status_id = " . $params[ 'selectstatus' ];

		}



	}








}
?>