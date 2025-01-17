<?php

//1. POSTデータ取得
$name = $_POST['name'];
$code = $_POST['code'];
$address = $_POST['address'];
$station = $_POST['station'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$teacher = $_POST['teacher'];
$schedule = isset($_POST['schedule']) ? implode(',', $_POST['schedule']) : ''; // 配列をカンマ区切りの文字列に変換
$soroteacher = $_POST['soroteacher'];
$content = $_POST['content'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//3. データ登録SQL作成
$stmt = $pdo->prepare(
  'INSERT INTO gs_bm_table (
        id, name, code, address, station, email, tel, fax, teacher, schedule, soroteacher, content, date
    ) VALUES (
        NULL, :name, :code, :address, :station, :email, :tel, :fax, :teacher, :schedule, :soroteacher, :content, now()
    )'
);

// バインド変数を設定
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':code', $code, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':station', $station, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':fax', $fax, PDO::PARAM_STR);
$stmt->bindValue(':teacher', $teacher, PDO::PARAM_STR);
$stmt->bindValue(':schedule', $schedule, PDO::PARAM_STR);
$stmt->bindValue(':soroteacher', $soroteacher, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);

// 実行
$status = $stmt->execute();

//4. データ登録処理後
if ($status === false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:' . $error[2]);
} else {
  // index.phpへリダイレクト
  header('Location: index.php');
}
