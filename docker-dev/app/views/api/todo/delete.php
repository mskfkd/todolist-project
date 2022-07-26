<?php
require_once(dirname(__FILE__). "/../../../controllers/TodoController.php");

$todo_id = $_POST[ "todo_id" ];
error_log("todo_id" . $todo_id);

//$controller = new TodoController();
//$delete = $controller->delete( $todo_id );
//var_dump($delete);
//
//if( $delete === true ) {
//    return true;
//}

$response = [ 
    "result" => "success",
    "todo_id" => $todo_id,
];
//error_log("response" . $response);
echo json_encode( $response );

?>