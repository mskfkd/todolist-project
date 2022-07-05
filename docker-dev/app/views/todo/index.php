<?php
require_once("./../../controllers/TodoController.php");

$controller = new TodoController();
$todos = $controller->index();

if( isset( $_REQUEST[ "action" ] ) === true 
	&& $_REQUEST[ "action" ] === "delete" ) {

	$controller->delete( $_REQUEST[ "todo_id" ] );

}
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>to do リスト一覧</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
						<th><button class="delete_btn" id="<?php echo $todo["id"];?>">削除</button></th>
					</tr>

				<?php
				endforeach;
				?>
			</form>
	</table>
	<a href="./../../views/todo/new.php">新規作成</a>
	<script>

				$(function () {
						$('.delete_btn').on( 'click', function() {

								var todo_id = $(this).attr('id');

								$.ajax( {
										type: "POST",
										dataType: "json",
										url: "./../../views/api/todo/delete.php",
										data: { "todo_id" : todo_id}
								})
								.done( ( data ) => {
										console.log( "success" , data );
								})
								.fail( (error) => {
										console.log( "fail", error );
								});

						});



				});

	</script>
</body>

</html>