<?php

require_once( "./../../controllers/TodoController.php" );

$controller = new TodoController();
$data = $controller->detail();
$todo = $data[ 'todo' ];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>詳細</title>
</head>
<body>
	<table>
		<tr>
			<th>タイトル</th>
			<th>詳細</th>
			<th>期限</th>
			<th>完了日時</th>
			<th>作成日時</th>
		</tr>
			<tr>
				<td>
			<?php echo $todo[ "title" ]; ?>
				</td>
				<td>
			<?php echo $todo[ "detail" ]; ?>
				</td>
				<td>
			<?php echo $todo[ "end_at" ]; ?>
				</td>
				<td>
			<?php echo $todo[ "deleted_at" ]; ?>
				</td>
				<td>
			<?php echo $todo[ "created_at" ]; ?>
				</td>
			</tr>
	</table>
	
	</body>
