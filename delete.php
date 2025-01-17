<?php
// 1. POSTデータ取得
$id = $_POST['id'];

// 2. DB接続
require_once('funcs.php');
$pdo = db_conn();

// 3. 削除フラグを1に更新（論理削除）
$stmt = $pdo->prepare('UPDATE gs_bm_table SET is_deleted = 1 WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); // 実行

// 4. データ削除処理後
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: select.php'); // 一覧ページへ遷移
    exit();
}
