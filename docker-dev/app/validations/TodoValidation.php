<?php
require_once("./../../models/Todo.php");
require_once("./../../controllers/TodoController.php");

class TodoValidation
{
	public $errors = [];

	public function postCheck($params)
	{
		//session_start();
		$this->errors = $errors;
		$todos = [];

		$user = new User;
		$todos = $user->getAllId();

		$tmpData = [];
		$i = 1;

		foreach ( $todos as $datas ) {
			$tmpData[ $i ] = $datas[ "id" ];
			$i++;
		}

		$status = [];



		if ( array_key_exists( $params[ "userId" ], $tmpData ) === false) {

			$this->errors[ "userId" ] = false;

		}

		//	titleは空欄でないか
		if (
			is_null( $params[ "title" ] ) === true
			|| $params[ "title" ] === ""
		) {

			$this->errors[ "title" ] = false;

		}

		//	endatは空欄でないか
		if (
			is_null( $params[ "endAt" ] ) === true
			|| $params[ "endAt" ] === ""
		) {

			$this->errors[ "endAt" ] = false;

		}

		if ( count( $this->errors ) > 0) {
			return false;
		}

		return true;
	}

	public function getErrorMessage( )
	{
//		$this->errors = $errors;

		if ( $this->errors[ "userId" ] === false ) {

			$this->errors[ "userId" ] = "登録のないユーザーidです。";
		}

		if ( $this->errors[ "title" ] === false ) {

			$this->errors[ "title" ] = "タイトルが空欄のようです。";
		}

		if ($this->errors[ "endAt" ] === false) {

			$this->errors[ "endAt" ] = "期限が設定されていないようです。";
		}

		return $this->errors;
	}
}
