<?php
require_once( "./../../models/Todo.php" );
require_once( "./../../controllers/TodoController.php" );

class TodoValidation {

	public function postCheck( $params ) {
		session_start();
		$todos = [];

		$todo = new Todo;
		$todos = $todo->findId();

		$tmpData = [];
		$i = 1;
		
		foreach( $todos as $datas ) {
			$tmpData[ $i ] = $datas[ "id" ];
			$i++;
		}

//		foreach( $params as $param ) {
	$messages = [];

		if( array_key_exists( $params[ "userId" ], $tmpData ) === false ) {
	//		$_SESSION[ "user_id" ] = $passTodo[ "userId" ];
	//		$userId = $_SESSION[ "user_id" ];
	//		echo $userId;

			$messages[ "userId" ] = "登録のないユーザーidです。";
//			return false;

		}

//	titleは空欄でないか
		if( !isset($params[ "title" ]) ) {

	//		$_SESSION[ "title" ] = $passTodo[ "title" ];
	//		$title = $_SESSION[ "title" ];
	//		echo $title;

			$messages[ "title" ] = "タイトルが空欄のようです。";
//			return false;

		}

//	endatは空欄でないか
			if( !isset($params[ "endAt" ]) ) {

				$messages[ "endAt" ] = "期限が設定されていないようです。";
//				return false;

		}

		if ( count( $messages ) > 0 ){
			var_dump( $messages );
				return $messages;
		}

	//}
		return true;

	}









}




?>
