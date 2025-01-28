<?php
// 必要な関数ファイルの読み込み
require_once('funcs.php');
$pdo = db_conn();

// フォームがPOSTで送信された場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力された値を取得
    $name = $_POST['name'];
    $lid = $_POST['lid'];
    $lpw = $_POST['lpw'];
    $kanri_flg = isset($_POST['kanri_flg']) ? 1 : 0;

    // バリデーション: 必須フィールドが空でないか
    if (empty($name) || empty($lid) || empty($lpw)) {
        $error_message = 'すべてのフィールドを入力してください。';
    } else {
        // ログインIDが重複していないか確認
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM gs_user_table WHERE lid = ?");
        $stmt->execute([$lid]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $error_message = 'このログインIDはすでに使用されています。';
        } else {
            // パスワードをハッシュ化
            $lpw_hashed = password_hash($lpw, PASSWORD_DEFAULT);

            // データベースにユーザー情報を挿入
            $stmt = $pdo->prepare("INSERT INTO gs_user_table (name, lid, lpw, kanri_flg, life_flg) VALUES (?, ?, ?, ?, 0)");
            $stmt->execute([$name, $lid, $lpw_hashed, $kanri_flg]);

            // 登録完了メッセージ
            echo '登録完了！<br>';
            echo '<a href="login.php">ログインページへ</a>';
            exit(); // 登録が成功したら処理を終了
        }
    }
}
?>

<!-- ユーザー登録フォーム -->
<form method="post">
    名前: <input type="text" name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>"><br>
    ログインID: <input type="text" name="lid" value="<?= isset($lid) ? htmlspecialchars($lid) : '' ?>"><br>
    パスワード: <input type="password" name="lpw"><br>
    管理者: <input type="checkbox" name="kanri_flg"><br>
    <input type="submit" value="登録">
</form>

<?php
// エラーメッセージがあれば表示
if (isset($error_message)) {
    echo '<p style="color:red;">' . htmlspecialchars($error_message) . '</p>';
}
?>