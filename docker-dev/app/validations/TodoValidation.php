<?php
require_once( "./../../models/Todo.php" );
require_once( "./../../controllers/TodoController.php" );

class TodoValidation {

	public function postCheck( $passToTodo ) {
		$todos = [];
//		$passToTodo = [
//                        "userId" => $_GET[ "user_id" ],
//	                "title"  => $_GET[ "title" ],
//		        "detail" => $_GET[ "detail" ],
//			"endAt"  => $_GET[ "end_at" ],
//			      ];

		session_start();

		$todos = Todo::findId();
		
		if( array_key_exists( $passTodo[ "userId" ], $todos ) === false ) {
			$_SESSION[ "user_id" ] = $passTodo[ "userId" ];
			return false;

		}

//titleは空欄でないか
		if( !$passTodo[ "title" ] ) {

			$_SESSION[ "title" ] = $passTodo[ "title" ];
			return false;

		}

//endatは空欄でないか
		if( !$passTodo[ "endAt" ] ) {

			$_SESSION[ "end_at" ] = $passTodo[ "endAt" ];
			return false;

		}



	}






}




?>
