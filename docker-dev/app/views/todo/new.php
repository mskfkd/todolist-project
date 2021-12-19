<?php
require_once( "./../../controllers/TodoController.php" );
require_once( "./../../models/Todo.php" );
require_once( "./../../validations/TodoValidation.php" );

$controller = new TodoController();

if( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
	
	$requests = $controller->store();
//	return $requests;

} else {

	$requests = $controller->new();
//	return $requests;
var_dump( $requests);

}

session_start();
?> 
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規作成</title>
</head>
<body>
    <h1>新規作成</h1>
	<form action="<?php echo $requests;?>" method="POST">
		<div>
			<p>ユーザーID</p>
			<input type="text" name="user_id" value="<?php if(!isset($_GET[ "user_id" ])) { echo $userId = $requests[ "userId" ];} ?>">
		</div>
		<div>
		<div>
			<p>タイトル</p>
			<input type="text" name="title" value="<?php if( !isset($_GET[ "title" ])) { echo $title = $requests[ "title" ]; } ?>">
		</div>
		<div>
			<p>タスク詳細</p>
			<textarea name="detail" rows="5" placeholder="詳細を入力" value="<?php if(!isset($_GET[ "detail" ])) { echo $detail = $requests[ "detail" ];}?>"></textarea>
		</div>
		<div>
			<p>期限</p>
			<input type="date" name="end_at" value="<?php if( !isset($_GET[ "end_at" ])) { echo $endAt = $requests[ "endAt" ]; } ?>">
		</div>
		<div>
			<input type="submit" name="submit" value="追加">
		</div>

	</form>
</body>
</html>





