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

}


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
<!--			<input type="text" name="user_id" value="<?php if(!isset($_POST[ "user_id" ])) { echo $_POST[ "user_id" ];} ?>">   -->
			<input type="text" name="user_id" value="<?php echo $userId;?>">
		</div>
		<div>
		<div>
			<p>タイトル</p>
<!--			<input type="text" name="title" value="<?php if( !isset($_POST[ "title" ])) { echo $_POST[ "title" ]; } ?>">  -->
			<input type="text" name="title" value="<?php echo $title; ?>">
		</div>
		<div>
			<p>タスク詳細</p>
			<textarea name="detail" rows="5" placeholder="詳細を入力" value="<?php if(!isset($_POST[ "detail" ])) { echo $_POST[ "detail" ];}?>"></textarea>
		</div>
		<div>
			<p>期限</p>
<!--			<input type="date" name="end_at" value="<?php if( !isset($_POST[ "end_at" ])) { echo $_POST[ "end_at" ]; } ?>">   -->
			<input type="date" name="end_at" value="<?php echo $endAt; ?>">
		</div>
		<div>
			<input type="submit" name="submit" value="追加">
		</div>

	</form>
</body>
</html>





