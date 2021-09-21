<?php
//require( "../config/db.php" );
//require( "../models/Todo.php" );
require( "../controllers/TodoController.php" );

$TodoController = new TodoController();
$todos = $TodoController->index();

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
		<?php
			foreach( $todos as $key => $todo ){
		?>
			<tr>
			<th><?php 
				echo $todo[ "title" ];
			 ?></th>
			<th><?php 
				echo $todo[ "end_at" ];
			 ?></th>
			</tr>

		<?php
			}
		?>
	</table>
</body>
</html>





