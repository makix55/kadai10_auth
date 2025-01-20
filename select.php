<?php
// DB接続
require_once('funcs.php');
$pdo = db_conn();

// ログインチェック
if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
    // 未ログイン、またはセッションIDが一致しない場合はログイン画面へリダイレクト
    header('Location: login.php');
    exit();
    }

// 検索条件
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$search_id = isset($_GET['search_id']) ? $_GET['search_id'] : '';

// データ取得のSQL準備
$sql = "SELECT * FROM gs_bm_table WHERE is_deleted = 0";

// 検索条件に基づいてSQL文を変更
if ($search_name !== '') {
  $sql .= " AND name LIKE :search_name";
}
if ($search_id !== '') {
  $sql .= " AND id = :search_id";
}

$stmt = $pdo->prepare($sql);

// 検索パラメータのバインド
if ($search_name !== '') {
  $stmt->bindValue(':search_name', '%' . $search_name . '%', PDO::PARAM_STR);
}
if ($search_id !== '') {
  $stmt->bindValue(':search_id', $search_id, PDO::PARAM_INT);
}

$status = $stmt->execute();

if ($status === false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery: " . $error[2]);
} else {
  // データ取得
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>データ一覧</title>
  <link rel="stylesheet" href="css/style2.css">
</head>

<body id="main">
    <div class="logout-btn-container">
      <a href="logout.php"><button>ログアウト</button></a>
    </div>
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">データ登録画面</a>
          </div>
        </div>
      </nav>
    </header>

    <div class="container">
      <h2>講師派遣申込一覧表</h2>

      <!-- 検索フォーム -->
      <form action="select.php" method="GET">
        <label for="search_id">「受付番号」:</label>
        <input type="text" name="search_id" id="search_id" value="<?= isset($_GET['search_id']) ? h($_GET['search_id']) : '' ?>">

        <label for="search_name">「学校名」:</label>
        <input type="text" name="search_name" id="search_name" value="<?= isset($_GET['search_name']) ? h($_GET['search_name']) : '' ?>">

        <button type="submit">検 索</button>
        <button type="button" onclick="clearSearch()">全てのデータを表示</button>
      </form>

      <script>
        function clearSearch() {
          window.location.href = "select.php";
        }
      </script>

      <table class="styled-table">
        <thead>
          <tr>
            <th>受付No.</th>
            <th>学校名</th>
            <th>郵便番号</th>
            <th>所在地</th>
            <th>最寄駅・バス停</th>
            <th>Email</th>
            <th>電話番号</th>
            <th>FAX番号</th>
            <th>担当の先生名</th>
            <th>授業希望日</th>
            <th>希望の講師</th>
            <th>その他ご要望</th>
            <th>登録日</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $row): ?>
            <tr>
              <td><?= h($row['id']) ?></td>
              <td><?= h($row['name']) ?></td>
              <td><?= h($row['code']) ?></td>
              <td><?= h($row['address']) ?></td>
              <td><?= h($row['station']) ?></td>
              <td><?= h($row['email']) ?></td>
              <td><?= h($row['tel']) ?></td>
              <td><?= h($row['fax']) ?></td>
              <td><?= h($row['teacher']) ?></td>
              <td><?= h($row['schedule']) ?></td>
              <td><?= h($row['soroteacher']) ?></td>
              <td><?= h($row['content']) ?></td>
              <td><?= h($row['date']) ?></td>
              <td>
                <!-- 編集ボタン -->
                <form action="update.php" method="GET" style="display:inline;">
                  <input type="hidden" name="id" value="<?= h($row['id']) ?>">
                  <button type="submit">編 集</button>
                </form>
                <!-- 論理削除ボタン -->
                <form action="delete.php" method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?= h($row['id']) ?>">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？');">削 除</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>

  </body>

</html>