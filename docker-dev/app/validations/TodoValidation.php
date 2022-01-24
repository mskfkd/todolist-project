<?php
require_once( "./../../models/Todo.php" );
require_once( "./../../controllers/TodoController.php" );

class TodoValidation {

	public function postCheck( $params ) {
		//session_start();
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
		global $status;
		$status = [];



		if( array_key_exists( $params[ "userId" ], $tmpData ) === false ) {

			$status[ "userId" ] = false;
//			return false;

		}

//	titleは空欄でないか
		if( is_null( $params[ "title" ] ) === true
			|| $params[ "title" ] === "" ) {

			$status[ "title" ] = false;
//			return false;

		}

//	endatは空欄でないか
			if( !is_null( $params[ "endAt" ] ) === true
				|| $params[ "endAt" ] === "" ) {

				$status[ "endAt" ] = false;
//				return false;

			}

		if ( count( $status ) > 0 ){
			var_dump( $status );
			return $status;
				return false;
		}

	//}
		return true;

	}

	public function getErrorMessage( $status ) {
		//statusの内容をどうやって渡すか
var_dump( $status );
		
		if( $status[ "userId" ] === false ){

			$messages[ "userId" ] = "登録のないユーザーidです。";

		}
		
		if( $status[ "title" ] === false ) {

			$messages[ "title" ] = "タイトルが空欄のようです。";

		}

		if( $status[ "endAt" ] === false  ) {

			$messages[ "endAt" ] = "期限が設定されていないようです。";

		}
		
		return $messages;

	}


}




?>
