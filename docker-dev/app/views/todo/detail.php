<?php

require_once( "./../../controllers/TodoController.php" );


$TodoController = new TodoController();
$details = $TodoController->detail();


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
		<?php
			if( !$details ) { 
//				echo $details;
//				var_dump( $details );
//				exit();
			}else {
			foreach( $details as $key => $detail ) {
		?>
			<tr>
				<td>
			<?php echo $detail[ "title" ]; ?>
				</td>
				<td>
			<?php echo $detail[ "detail" ]; ?>
				</td>
				<td>
			<?php echo $detail[ "end_at" ]; ?>
				</td>
				<td>
			<?php echo $detail[ "deleted_at" ]; ?>
				</td>
				<td>
			<?php echo $detail[ "created_at" ]; ?>
				</td>
			</tr>
		<?php
				}
			}
		?>
	</table>	
	
	</body>
