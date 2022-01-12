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

			$messages[ "userId" ] = "登録のないユーザーidです。";
//			return false;

		}

//	titleは空欄でないか
		if( is_null( $params[ "title" ] ) === true
			|| $params[ "title" ] === "" ) {

			$messages[ "title" ] = "タイトルが空欄のようです。";
//			return false;

		}

//	endatは空欄でないか
			if( !is_null( $params[ "endAt" ] ) === true
				|| $params[ "endAt" ] === "" ) {

				$messages[ "endAt" ] = "期限が設定されていないようです。";
//				return false;

			}

		if ( count( $messages ) > 0 ){

				return $messages;
		}

	//}
		return true;

	}









}




?>
