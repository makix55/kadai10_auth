<?php
require_once('funcs.php');
$pdo = db_conn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lid = $_POST['lid'];
    $lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT); // パスワードをハッシュ化
    $kanri_flg = isset($_POST['kanri_flg']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO gs_user_table (name, lid, lpw, kanri_flg, life_flg) VALUES (?, ?, ?, ?, 0)");
    $stmt->execute([$name, $lid, $lpw, $kanri_flg]);

    echo '登録完了！<br>';
    echo '<a href="login.php">ログインページへ</a>';
}
?>

<form method="post">
    名前: <input type="text" name="name"><br>
    ログインID: <input type="text" name="lid"><br>
    パスワード: <input type="password" name="lpw"><br>
    管理者: <input type="checkbox" name="kanri_flg"><br>
    <input type="submit" value="登録">
</form>