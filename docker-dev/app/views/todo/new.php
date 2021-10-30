<?php
require_once( "./../../controllers/TodoController.php" );

$TodoController = new TodoController();
//$test = $_POST[ "test" ];
//echo $test;

if( $_SERVER[ "REQUEST_METHOD" ] == "GET" ) {
//if( $test == "GET" ) {
	$requests = $TodoController->new();
} else {
	$requests = $TodoController->store();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規作成</title>
</head>
<body>
	<?php echo $requests?>
</body>
</html>





