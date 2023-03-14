<?php
require_once("./../../controllers/TodoController.php");

$controller = new TodoController();
// $params = $controller->index();
$results = [];

if ( $_GET ) {
	$params = $controller->index( $_GET );
} else {
	$params = $controller->index();
}
$todos = $params[ 'todos' ];
$page = $params[ 'page' ];
$range = $params[ 'range' ];

ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>to do リスト一覧</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/stylesheet.css">
</head>


<body>
	<table>
		<tr>
			<th>項目</th>
			<th>期限</th>
		</tr>
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
							<input type="checkbox" id="<?php echo $todo[ "id" ]?>" value="<?php echo $todo["id"];?>"/>完了
						</th>
						<th>
							<button class="delete_btn" id="<?php echo $todo["id"];?>">削除</button>
						</th>
					</tr>

				<?php
				endforeach;
				?>
	</table>
	<div class="pagenation">
		<?php if( $page >= 2): ?>
			<a href="index.php?page=<?php echo( $page - 1); ?>" class="page_feed">&laquo;</a>
		<?php else:?>
			<span class="first_page">&laquo;</span>
		<?php endif; ?>
		<?php for( $i = 1; $i <= $range[ 'maxPage' ]; $i++ ) : ?>
			<?php if( $i >= $page - $range[ 'range' ] && $i <= $page + $range[ 'range' ] ) :?>
				<?php if( $i == $page ) : ?>
					<span class="now_page_number"><?php echo $i; ?></span>
				<?php else: ?>
					<a href="?page=<?php echo $i; ?>" class="pagenumber"><?php echo $i;?></a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endfor; ?>
		<?php if( $page < $range[ 'maxPage' ] ) :?>
			<a href="index.php?page=<?php echo ( $page + 1 );?>" class="page_feed">&raquo;</a>
		<?php else :?>
			<span class="first_last_page">&raquo;</span>
		<?php endif; ?>
	</div>
	<a href="./../../views/todo/new.php">新規作成</a>
	<form action="./index.php" method="GET">
		<label for="title">タイトル</label>
		<input type="text" name="title">
		<label for="deadline">締め切り日</label>
		<input type="date" name="deadline1">
		~
		<input type="date" name="deadline2">
		<select name="selectstatus" id="selectstatus">
			<option name="none" value="0">選択してください</option>
			<option name="comp" value="2">完了</option>
			<option name="incomp" value="1">未完了</option>
		</select>
		
		<input type="submit" name="search"  value="検索">
	</form>
			<?php if( isset( $results ) ):?>
				<tr>
					<th><?php echo $results[ 'title' ];?></th>
					<th><?php echo $results[ 'end_at' ];?></th>
				</tr>
			<?php endif;?>
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

						$( 'input[type="checkbox"]' ).change( function() {
//画面更新時にチェックを引き継ぐ
							if( $(this).prop( 'checked' )) {
								let todo_id = $(this).val();
								// let todo_id = $(this).attr('id');
								// localStorage.setItem(name, todo_id);

								$.ajax(
									{
									type: "POST",
											dataType: "json",
											url: "./../api/todo/update_status.php",
											data: { "todo_id" : todo_id}
									}
								)
								.done ( (data) => {

									console.log("complete");
									alert( "タスクが完了しました。" );
									$(this).closest("tr").css("text-decoration", "line-through");
									window.location.href = "./index.php";
									// localStorage.clear();

								})
								.fail ( (fail) => {

									console.log("fail");
									alert( "タスクのステータス変更に失敗しました。" );
									window.location.href = "./index.php";
									// localStorage.getItem( todo_id );

								});
								
							}
							else {
								$(this).closest("tr").css("text-decoration", "none");
								// localStorage.getItem( todo_id );
							}
						});

			});








	</script>
</body>

</html>