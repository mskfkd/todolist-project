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

	public function new() {

	}


	public function store() {

		$userId = $_REQUEST[ "user_id" ];
		$title = $_REQUEST[ "title" ];
		$detail = $_REQUEST[ "detail" ];
		$endAt = $_REQUEST[ "end_at" ];
		$insert = Todo::insert( $userId, $title, $detail, $endAt );

		if( $insert === true ) {
			echo "登録が完了しました。";
		}else {
			echo "登録に失敗しました。";
		}


		return;


	}


}












?>
