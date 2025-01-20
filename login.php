<?php
// セッション開始
session_start();
require_once('funcs.php');

// POSTデータ取得
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lid = isset($_POST['lid']) ? $_POST['lid'] : '';
    $lpw = isset($_POST['lpw']) ? $_POST['lpw'] : '';

    // DB接続
    $pdo = db_conn();

    // SQL準備
    $sql = "SELECT * FROM gs_user_table WHERE lid = :lid AND is_deleted = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);

    $status = $stmt->execute();

    if ($status === false) {
        $error = $stmt->errorInfo();
        exit("ErrorQuery: " . $error[2]);
    }

    // ユーザー情報取得
    $val = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($val && password_verify($lpw, $val['lpw'])) {
        // セッションにユーザー情報を保存
        $_SESSION['chk_ssid'] = session_id();
        $_SESSION['user_name'] = $val['name']; // 任意の情報
        $_SESSION['user_id'] = $val['id']; // 任意の情報

        // ログイン成功後、リダイレクト
        header('Location: select.php');
        exit();
    } else {
        // ログイン失敗時のエラーメッセージ
        $error_message = "ログインIDまたはパスワードが間違っています。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="css/style3.css">
</head>

<body style="background-color: #f9f0f6;">
    <div class="login-container">
        <h2>ログイン</h2>

        <?php if (isset($error_message)): ?>
            <div class="error-message"><?= h($error_message) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="lid">ID:</label>
            <input type="text" id="lid" name="lid" required>

            <label for="lpw">パスワード:</label>
            <input type="password" id="lpw" name="lpw" required>

            <button type="submit">ログイン</button>
        </form>
    </div>
</body>

</html>