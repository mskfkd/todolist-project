<?php

require_once("./../../controllers/TodoController.php");

$todo_id = $_POST[ "todo_id" ];
var_dump($todo_id);

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
echo json_encode( $response );

?>