<?php
require_once(dirname(__FILE__). "./../../models/Todo.php");
require_once(dirname(__FILE__). "./../../validations/TodoValidation.php");

class DeleteController {

  public function delete( $todo ) {

		$params = [
			"todoId" => $_REQUEST[ "todo_id" ],
		];

		$validator = new TodoValidation;
		$validate = $validator->checkDeleteTodo($params);

		if ($validate === false) {
			$message = $validator->getErrorMessage();
			$_SESSION["errors"] = $message;

			exit();
		}

		$validated_data = $validator->getData( $params[ "todoId" ] );

		$todo = new Todo;
		$result = $todo->delete($validated_data,$params);

		if ($result === false) {
			return false;
		}


		return $result;


	}





}




?>