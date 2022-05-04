<?php
require_once("./../../controllers/TodoController.php");
require_once("./../../models/Todo.php");
require_once("./../../validations/TodoValidation.php");

$message = [];
$controller = new TodoController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$response = $controller->update($params);

} else {

	$response = $controller->edit();
	$todo_id = $response["todoId"];
}

session_start();
$message = $_SESSION["errors"];
if (isset($_SESSION["errors"])) {
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
		<?php	if (count($message) > 0): ?> 
			<?php foreach ($message as $data) :	?>
					<li><?php echo $data;?></li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<h1>編集</h1>
	<form action="./../../views/todo/edit.php" method="POST">
		<div>
			<p>todoID</p>
			<input type="text" name="todoId" value="<?php echo $todo_id; ?>">
		</div>
		<div>
			<div>
				<p>タイトル</p>
				<input type="text" name="title" value="edit_test">
			</div>
			<div>
				<p>タスク詳細</p>
				<textarea name="detail" rows="5" value="">this is 2nd update test.</textarea>
			</div>
			<div>
				<p>期限</p>
				<input type="text" name="end_at" value="2022-01-31 23:59:59">
			</div>
			<div>
				<input type="submit" name="submit" value="編集">
			</div>

	</form>
</body>