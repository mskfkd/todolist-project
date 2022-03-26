<?php
require_once("./../../models/Todo.php");
require_once("./../../models/User.php");
require_once("./../../controllers/TodoController.php");

class TodoValidation
{
	//	public $errors = [];
	const ERROR_USER_NOT_EXIST = "登録のないユーザーidです。";
	const ERROR_NO_TITLE = "タイトルが空欄のようです。";
	const ERROR_NO_LIMIT =  "期限が設定されていないようです。";

	public function postCheck($params)
	{
		//session_start();
		//		$this->errors = $errors;
		$users = [];

		$user = new User;
		$users = $user->isExistById($params["userId"]);

		$status = [];



		if (array_key_exists($params["userId"], $users) === false) {

			$this->errors["userId"] = self::ERROR_USER_NOT_EXIST;
		}

		//	titleは空欄でないか
		if (
			is_null($params["title"]) === true
			|| $params["title"] === ""
		) {

			$this->errors["title"] = self::ERROR_NO_TITLE;
		}

		//	endatは空欄でないか
		if (
			is_null($params["endAt"]) === true
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
		//		$this->errors = $errors;
		return $this->errors;
	}
}
