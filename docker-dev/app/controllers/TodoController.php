<?php

require_once( "./../../models/Todo.php" );

class TodoController {
	public function index() {
		$todos = Todo::findAll();

		return $todos;
	}

	public function detail() {

		//GETパラメータ取得
		$todo_id = $_GET[ "todo_id" ];

		$todo = Todo::findById( $todo_id );

//		if( !$todo ) {
//		   $todo = 'error'; 
//		   header("Location:./../../views/error/404.php");
//		   exit();
//		}


		return $todo;

	}

	public function insertDb() {

		$title = $_POST[ "title" ];
		$detail = $_POST[ "detail" ];
		$endAt = $_POST[ "end_at" ];
		$insert = Todo::insert( $title, $detail, $endAt );
		var_dump( $insert );

		if( $insert === true ) {
			echo "登録が完了しました。";
		}else {
			echo "登録に失敗しました。";
		}


		return;

	}


	public function store() {

	}


}












?>
