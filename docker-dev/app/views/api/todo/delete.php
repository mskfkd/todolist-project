<?php
require_once(dirname(__FILE__) . "/../../../controllers/api/DeleteController.php");

$todo_id = $_POST[ "todo_id" ];

$controller = new DeleteController();
$delete = $controller->delete( $todo_id );

$response = [ 
    "result" => $delete,
    "todo_id" => $todo_id,
];

if ( $response[ "result" ] === false ) {
    echo json_encode( "error" );
}

//$response = [ 
//    "result" => "success",
//    "todo_id" => $todo_id,
//];
echo json_encode( $response );

?>