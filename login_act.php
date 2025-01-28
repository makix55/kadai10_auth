<?php
// セッションの開始
session_start();

// POSTデータの取得
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

// funcs.php の関数を利用
require_once('funcs.php');
$pdo = db_conn();

// SQLの準備（gs_user_tableからIDとパスワードを検索）
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時のエラー処理
if ($status === false) {
    sql_error($stmt);
}

// 抽出データの取得
$val = $stmt->fetch();

// パスワードの検証とログイン処理
if ($val && password_verify($lpw, $val['lpw'])) {
    // ログイン成功時
    $_SESSION['chk_ssid'] = session_id(); // セッションIDの生成
    $_SESSION['user_name'] = $val['name']; // ユーザー名をセッションに保存
    header('Location: select.php'); // データ一覧ページへリダイレクト
    exit();
} else {
    // ログイン失敗時（エラーメッセージを設定してログインページに戻る）
    $error_message = 'ログインIDまたはパスワードが間違っています。';
    $_SESSION['error_message'] = $error_message;
    header('Location: login.php');
    exit();
}
