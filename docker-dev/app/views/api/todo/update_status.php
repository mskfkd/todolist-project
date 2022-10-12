<?php
require_once(dirname(__FILE__) . "/../../../controllers/api/ApiTodoController.php");


$todo_id = $_POST[ "todo_id" ];

$controller = new ApiTodoController();
$response = $controller->updateStatus( $todo_id );



echo $response;

?>