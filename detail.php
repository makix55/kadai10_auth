<?php
//1. GETデータ取得
$id = $_GET['id'];

//2. DB接続
require_once('funcs.php');
$pdo = db_conn();

//3. データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ編集</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="index.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>申込データ編集</legend>
                <label>学校名：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>郵便番号：<input type="text" name="code" value="<?= $result['code'] ?>"></label><br>
                <label>所在地：<input type="text" name="address" value="<?= $result['address'] ?>"></label><br>
                <label>最寄駅・バス停：<input type="text" name="station" value="<?= $result['station'] ?>"></label><br>
                <label>Email：<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
                <label>電話番号：<input type="text" name="tel" value="<?= $result['tel'] ?>"></label><br>
                <label>FAX番号：<input type="text" name="fax" value="<?= $result['fax'] ?>"></label><br>
                <label>担当の先生名：<input type="text" name="teacher" value="<?= $result['teacher'] ?>"></label><br>
                <label>授業希望日：<input type="text" name="schedule" value="<?= $result['schedule'] ?>"></label><br>
                <label>希望の講師：<input type="text" name="soroteacher" value="<?= $result['soroteacher'] ?>"></label><br>
                <label>その他ご要望：<textarea name="content" rows="4" cols="40"><?= $result['content'] ?></textarea></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>