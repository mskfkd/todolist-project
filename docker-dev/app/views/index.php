<?php
	require( "../config/db.php" );
	require( "../models/Todo.php" );
	
	$Todo = new Todo();
	$tableDatas = $Todo->findAll();
//	var_dump( $tableDatas);

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
			foreach( $tableDatas as $key => $data ){
		?>
			<tr>
			<th><?php 
				echo $data[ "title" ];
			 ?></th>
			<th><?php 
				echo $data[ "end_at" ];
			 ?></th>
			</tr>

		<?php
			}
		?>
	</table>
</body>
</html>





