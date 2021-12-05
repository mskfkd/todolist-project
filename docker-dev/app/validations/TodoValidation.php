<?php
require_once( "./../../models/Todo.php" );
require_once( "./../../controllers/TodoController.php" );

class TodoValidation {

	public function postCheck( $params ) {
		session_start();
		$todos = [];

		$todos = Todo::findId();
		
		if( array_key_exists( $passTodo[ "userId" ], $todos ) === false ) {
			$_SESSION[ "user_id" ] = $passTodo[ "userId" ];
			$userId = $_SESSION[ "user_id" ];
			return false;

		}

//titleは空欄でないか
		if( !$passTodo[ "title" ] ) {

			$_SESSION[ "title" ] = $passTodo[ "title" ];
			$title = $_SESSION[ "title" ];
			return false;

		}

//endatは空欄でないか
		if( !$passTodo[ "endAt" ] ) {

			$_SESSION[ "end_at" ] = $passTodo[ "endAt" ];
			$endAt = $_SESSION[ "end_at" ];
			return false;

		}

		return;

	}


	public function getData( $params ){
	
		return $params;	
	
	}







}




?>
