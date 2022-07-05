<?php

require_once("./../../controllers/TodoController.php");

$todo_id = $_POST[ "todo_id" ];

$controller = new TodoController();
$delete = $controller->delete( $todo_id );
var_dump($delete);

if( $delete !== false ) {
    return true;
}


?>