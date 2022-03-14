<?php
require_once("./../../controllers/TodoController.php");
require_once("./../../models/Todo.php");
require_once("./../../validations/TodoValidation.php");

$controller = new TodoController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$requests = $controller->update();
} else {

	$requests = $controller->edit();
	$user_id = $requests["userId"];
}

session_start();
$message = $_SESSION["message"];
if (isset($_SESSION["message"])) {
	session_destroy();
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>編集機能</title>
</head>

<body>
<ul>
		<?php
		//var_dump($errMsg);
		if (count($message) > 0) {
			foreach ($message as $data) :
		?>
				<li><?php echo $data;?></li>
		<?php
			endforeach;
		}
		?>
	</ul>
	<h1>編集</h1>
	<form action="./../../views/todo/edit.php" method="POST">
		<div>
			<p>ユーザーID</p>
			<input type="text" name="user_id" value="1">
		</div>
		<div>
			<div>
				<p>タイトル</p>
				<input type="text" name="title" value="編集テスト">
			</div>
			<div>
				<p>タスク詳細</p>
				<textarea name="detail" rows="5" value="">編集テスト、編集テスト、編集テスト、編集テスト</textarea>
			</div>
			<div>
				<p>期限</p>
				<input type="text" name="end_at" value="2022/04/30">
			</div>
			<div>
				<input type="submit" name="submit" value="編集">
			</div>

	</form>
</body>