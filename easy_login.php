<?php
//h関数を読み込みます
require_once 'h.php';
// password_verify()関数を読み込みます。
header('X_FRAME-OPTIONS:SAMEORIGIN');
session_start();
$userid[] ='admin'; //ユーザID
$username[] ='管理者'; //お名前
//　パスワード[pass1]をpassword_hash()関数でハッシュ化した文字列
$hash[] = '$2y$10$8s6pGnPEeTaWvwcNmVhd..tS2OCPBVtEWxPtOoS4jm7GCJQGYvPmy';

$userid[] = 'test';
$username[] = 'テスト';
//パスワード[pass2]をpassword_hash()関数でハッシュ化した文字列
$hash[] ='$2y$10$8s6pGnPEeTaWvwcNmVhd..tS2OCPBVtEWxPtOoS4jm7GCJQGYvPmy';

//エラーメッセージの変動を初期化します。
$error ='';

//認証済みかどうかのセッション変数を初期化します
if(! isset($_SESSION['auth'])) {
  $_SESSION['auth'] = false;
}

if (isset($_POST['userid']) && isset($_POST['password'])){
foreach ($userid as $key => $value) {
    if($_POST['userid'] === $userid[$key] &&
       //入力されたパスワード文字列とハッシュ化済みパスワードを照合します。
       password_verify($_POST['password'],$hash[$key])){
            //セッション固定化攻撃を防ぐため、セッションIDを変更します。
            session_regenerate_id(true);
            $_SESSION['auth'] = true;
            $_SESSION['username'] = $username[$key];
            break;
     }
            if($_SESSION['auth'] === false) {
            $error ='ユーザーIDかパスワードに誤りがあります。';
        }
    }
}
    if($_SESSION['auth'] !== true) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width=device-width,intitial-scale=1.0">
<title>簡単なログインフォームを作成したい</title>
</head>
<body>
<div id="login">
    <h1>認証ホーム</h1>
    <?php
    if($error) { // エラー分がセットされていれば赤色で表示
      echo '<p style="color:red;">' . h($error). '</p>';
    }
    ?>
<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="post">
    <dl>
        <dt><label for="userid">ユーザーID:</label></dt>
        <dd><input type="text" name="userid" value="" </dd>
    </dl>
    <dl>
        <dt><label for="password">パスワード:</label></dt>
        <dd><input type="password" name="password" id="password" value=""></dd>
    </dl>
        <input type="submit" name="submit" value="ログイン">
</form>
    </div>
</body>
</html>
<?php
//スクリプトを終了し、認証が必要なページが表示されないようにします。
    exit();
}