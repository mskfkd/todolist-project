<?php
require_once( "./../../controllers/TodoController.php" );
require_once( "./detail.php" );

$controller = new TodoController();
$todos = $controller->index();

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
			foreach( $todos as $key => $todo ):
		?>
			<tr>
			<th><a href="detail.php?todo_id=<?php 
				echo $todo[ "id" ];
			//	echo $todo[ 1 ];
			?>"><?php 
				echo $todo[ "title" ];
			 ?></a></th>
			<th><?php 
				echo $todo[ "end_at" ];
			 ?></th>
			</tr>

		<?php
			endforeach;
		?>
	</table>
</body>
</html>





