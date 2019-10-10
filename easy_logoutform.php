<?php
//セッションを開始します。
session_start();
//セッションを破棄します。
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viwport" content="width=device-width,initial-scale=1.0">
<title>ログアウト</title>
</head>
<body>
<div>
    <p>ログアウトしました</p>
    <p><a href="easy_loginform.php">戻る</a></p>
    </div>
    </body>
</html>