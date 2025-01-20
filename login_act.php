<?php
// 最初にSESSIONを開始！！ココ大事！！
session_start();

// POST値を受け取る
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

// フォームデータのバリデーション
if (empty($lid) || empty($lpw)) {
    header('Location: login.php?error=1'); // 入力が空の場合、エラーを表示
    exit();
}

// 1. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// 2. データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

// 3. SQL実行時にエラーがある場合STOP
if ($status === false) {
    // SQLエラーの詳細を表示
    $errorInfo = $stmt->errorInfo();
    echo "SQL Error: " . $errorInfo[2];
    exit();
}

// 4. 抽出データを取得
$val = $stmt->fetch();

// パスワードがハッシュ化されている場合（パスワードの検証）
if (password_verify($lpw, $val['lpw'])) { // ハッシュ化されている前提
    // Login成功時
    $_SESSION['chk_ssid'] = session_id();
    header('Location: select.php');
    exit();
} else {
    // Login失敗時（再度ログイン画面にリダイレクト）
    header('Location: login.php');
    exit();
}

