<?php
require_once(dirname(__FILE__). "./../models/Todo.php");
require_once(dirname(__FILE__). "./../models/User.php");
require_once(dirname(__FILE__). "./../controllers/TodoController.php");

class TodoValidation
{
	const ERROR_USER_NOT_EXIST = "登録のないユーザーidです。";
	const ERROR_TODO_NOT_EXIST = "登録のないtodoです。";
	const ERROR_NO_TITLE = "タイトルが空欄のようです。";
	const ERROR_NO_LIMIT =  "期限が設定を見直してください。";
	const ERROR_NO_STATUS =  "すでに完了済みのtodoのようです。";

	public function postCheck($params)
	{
		$users = [];

		$user = new User;
		$users = $user->isExistById($params["userId"]);

		$this->errors = [];



		if (array_key_exists($params["userId"], $users) === false) {

			$this->errors["userId"] = self::ERROR_USER_NOT_EXIST;
		}

		if (
			is_null($params["title"]) === true
			|| $params["title"] === ""
		) {

			$this->errors["title"] = self::ERROR_NO_TITLE;
		}

		if (
			$params["endAt"] <= date( "Y-m-d" )
			|| is_null($params["endAt"]) === true
			|| $params["endAt"] === ""
		) {

			$this->errors["endAt"] = self::ERROR_NO_LIMIT;
		}

		if (count($this->errors) > 0) {
			return false;
		}

		return true;
	}

	public function getErrorMessage()
	{
		return $this->errors;
	}

	public function checkTodo( $params ) {

		$this->errors = [];
		$checkTodoId = new Todo;
		$resultTodoId = $checkTodoId->findById( $params[ "todoId" ] );

		if( 
			$resultTodoId === 0
			|| $params["todoId"] === ""
			|| is_null( $params["todoId"] ) === true ) {
				$this->errors["todoId"] = self::ERROR_TODO_NOT_EXIST;
		}

		if (
			is_null($params["title"]) === true
			|| $params["title"] === ""
		) {

			$this->errors["title"] = self::ERROR_NO_TITLE;
		}

		if (
			$params["endAt"] <= date( "Y-m-d" )
			|| is_null($params["endAt"]) === true
			|| $params["endAt"] === ""
		) {

			$this->errors["endAt"] = self::ERROR_NO_LIMIT;
		}

		if (count($this->errors) > 0) {
			return false;
		}

		return true;

	}

	public function getData( $params )
	{

		$getTodoId = new Todo;
		$resultTodoId = $getTodoId->findById( $params );

		if( $resultTodoId === 0 ) {
				return false;
		}

		return $resultTodoId;


	}

	public function checkDeleteTodo( $params ) {

		$this->errors = [];

		if( !$params[ "todoId" ] ) {
			$this->errors[ "todoId" ] = "選択されたtodoはありません。";
			return false;
		}

		$Todo = new Todo;
		$resultTodoId = $Todo->findById( $params[ "todoId" ] );

		if( !$resultTodoId )	{
			$this->errors[ "todoId" ] = self::ERROR_TODO_NOT_EXIST;
		}

		if (count($this->errors) > 0) {
			return false;
		}

		return true;

	}




}
