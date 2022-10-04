<?php
require_once(dirname(__FILE__). "./../../models/Todo.php");
require_once(dirname(__FILE__). "./../../validations/TodoValidation.php");

class ApiTodoController {

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
			return json_encode( $result );
		}


		return json_encode($result);

	}

	public function updateStatus( $params ) {

		$response = [];

		$validator = new TodoValidation;
		$validate = $validator->checkStatusTodo($params);

		if ($validate === false) {
			$message = $validator->getErrorMessage();
			$_SESSION["errors"] = $message;

			exit();
		}

		$validated_data = $validator->getData( $params );
		$response[ "todo_id" ] = $validated_data[ "id" ];

		$todo = new Todo;
		$response[ "result" ] = $todo->updateStatus($validated_data);


		if ( $response[ "result" ] === false ) {
			return json_encode( $response );
		}

		return json_encode( $response );





	}





}




?>