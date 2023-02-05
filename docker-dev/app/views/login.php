<?php
require_once ( "./../controllers/LoginController.php" );


$login = new LoginController();

if( $_SERVER[ "REQUEST_SERVER" ] === "POST" ) {
    $response = $login->password();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div>
        <form action="./../../login.php" method="post">
            <label for="email">email</label>
            <input type="email" name="email">
            <label for="password">パスワード</label>
            <input type="password" name="password">
            <input type="submit" value="login">
        </form>
   </div> 
</body>
</html>