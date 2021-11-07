<?php
require_once( "./../../controllers/TodoController.php" );

$TodoController = new TodoController();
//$test = $_POST[ "test" ];
//echo $test;

if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
//if( $test == "GET" ) {
	$requests = $TodoController->store();
} else {
	$requests = $TodoController->new();
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





