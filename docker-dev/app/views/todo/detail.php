<?php

require_once( "./../../controllers/TodoController.php" );


$TodoController = new TodoController();
$details = $TodoController->detail( $todo_id );
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>詳細</title>
</head>
<body>
	<tr>
		<th>タイトル</th>
		<th>詳細</th>
		<th>期限</th>
		<th>完了日時</th>
		<th>作成日時</th>
	</tr>
	<?php
		foreach( $details as $key => $detail ) {
	?>
		<tr>
		<?php echo $detail[ "title" ]; ?>
		</tr>
		<tr>
		<?php echo $detail[ "detail" ]; ?>
		</tr>
		<tr>
		<?php echo $detail[ "end_at" ]; ?>
		</tr>
		<tr>
		<?php echo $detail[ "deleted_at" ]; ?>
		</tr>
		<tr>
		<?php echo $detail[ "created_at" ]; ?>
		</tr>
	<?php
		}
	?>


</body>
