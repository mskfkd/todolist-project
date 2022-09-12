<?php
require_once(dirname(__FILE__) . "/../../../controllers/api/ApiTodoController.php");


$todo_id = $_POST[ "todo_id" ];
error_log($todo_id);

$controller = new TodoController();
$updateStatus = $controller->UpdateStatus( $todo_id );
var_dump($updateStatus);

$response = [ 
  "result" => $updateStatus,
  "todo_id" => $todo_id,
];

if ( $response[ "result" ] === false ) {
  echo $updateStatus;
}

echo $updateStatus;

?>