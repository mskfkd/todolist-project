<?php
//define ( 'DB_USERNAME', 'misaki' );
//define ( 'DB_PASSWORD', 'misaki' );
//define ( 'DSN', 'mysql:host=127.0.0.1:8080; dbname=todolist; charset=utf8' );
//
//function db_connect () {
//	    $dbh = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
//	        return $dbh;
//}


// データベースに接続
try {
     $db = new PDO ( 'mysql:dbname=todolist;host=127.0.0.1:3306;charset=utf8', 'misaki', 'misaki' );
}catch ( PDOException $e ) {
     echo "DB接続できません。" . $e->getMessage ();
     exit;
}

$sql = "SELECT * FROM todos";

$result = $db->prepare( $sql );
$result->execute();
$dbData = $result->fetch_array (PDO::FETCH_ASSOC);



$tableDatas = [];

foreach( $dbData as $data) {
	$tableDatas[] = $data;
}

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
			foreach( $tabelDatas as $data){
		?>
			<tr>
			<th><?php echo $data[ 'title' ]; ?></th>
			<th><?php echo $data[ 'end_at'];?></th>
			</tr>

		<?php
			}
		?>
	</table>
</body>
</html>





