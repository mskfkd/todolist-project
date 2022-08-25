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
								?>
						</th>
						<th>
							<input type="checkbox" name="check[]" value="<?php echo $todo["id"]; ?>">完了
						</th>
						<th>
							<button class="delete_btn" id="<?php echo $todo["id"];?>">削除</button>
						</th>
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

								let todo_id = $(this).attr('id');

								if ( confirm( "削除してもよろしいですか?todo_id: " + todo_id ) ) {

									$('.delete_btn').prop( "disabled", true );

									$.ajax( {
											type: "POST",
											dataType: "json",
											url: "./../api/todo/delete.php",
											data: { "todo_id" : todo_id}
									})
									.done( ( data ) => {

										let data_stringfy = JSON.stringify( data );
										const result_json = JSON.parse( data_stringfy );

										if ( result_json === true ) {

											alert( "削除が完了しました。");	
											$('.delete_btn').prop( "enabled", true );
											window.location.href = "./index.php";

										} else {

											alert( "削除に失敗しました。" );	
											$('.delete_btn').prop( "enabled", true );
											window.location.href = "./index.php";

										}

									})
									.fail( (error) => {

										alert( "削除に失敗しました。");
										$('.delete_btn').prop( "enabled", true );
											window.location.href = "./index.php";

									});
								
								}

						});

				});










	</script>
</body>

</html>