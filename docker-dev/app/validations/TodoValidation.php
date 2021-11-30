<?php
require_once( "./../../models/Todo.php" );
require_once( "./../../controllers/TodoController.php" );

class TodoValidation {

	public function postCheck( $passToTodo ) {
		$todos = [];

//userIdはDBに登録されているものか
		$todos = TodoController::index();
		if( array_key_exists( $passTodo[ "userId" ], $todos ) === false ) {

			return false;

		}

//titleは空欄でないか
		if( !$passTodo[ "title" ] ) {

			return false;

		}

//endatは空欄でないか
		if( !$passTodo[ "endAt" ] ) {

			return false;

		}



	}






}




?>
