<?php
require_once(dirname(__FILE__) . "/../../../controllers/api/ApiTodoController.php");

$todo_id = $_POST[ "todo_id" ];

$controller = new ApiTodoController();
$delete = $controller->delete( $todo_id );

$response = [ 
    "result" => $delete,
    "todo_id" => $todo_id,
];

if ( $response[ "result" ] === false ) {
    echo $delete;
}
//$response = [ 
//    "result" => "success",
//    "todo_id" => $todo_id,
//];
echo $delete;

?>