<?php
require_once(dirname(__FILE__) . "/../../../controllers/api/ApiTodoController.php");


$todo_id = $_POST[ "todo_id" ];

$controller = new ApiTodoController();
$updateStatus = $controller->UpdateStatus( $todo_id );

$response = [ 
  "result" => $updateStatus,
  "todo_id" => $todo_id,
];

if ( $response[ "result" ] === false ) {
  echo $updateStatus;
}

echo $updateStatus;

?>