<?php
require_once("./../../controllers/TodoController.php");
require_once("./detail.php");

$controller = new TodoController();
$todos = $controller->index();


ini_set('display_errors', 1);
var_dump($todo);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>to do リスト一覧</title>
</head>

<body>
	<table>
		<tr>
			<th>項目</th>
			<th>期限</th>
		</tr>
			<form action="./../../views/todo/index.php" method="POST">
				<?php
				foreach ($todos as $key => $todo) :
				?>
					<tr>
						<th>
							<a name="todo" href="detail.php?todo_id=<?php echo $todo["id"];?>">
							<?php echo $todo["title"];?>
							</a>
							<input type="hidden" name="<?php echo $todo["id"]; ?>">
					</th>
						<th><?php
								echo $todo["end_at"];
								?></th>
						<th><input type="submit" name="delete" value="削除" ></th>
					</tr>

				<?php
				endforeach;
				?>
			</form>
	</table>
</body>

</html>