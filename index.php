<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        div {
            padding: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">そろばん講師派遣申込フォーム</a>
                </div>

        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>以下の欄に入力し、送信ボタンを押してください。</legend>
                <div class="form-group">
                    <label for="name">学校名：</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="code">郵便番号：</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                </div>
                <div class="form-group">
                    <label for="address">所在地：</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="station">最寄駅、バス停：</label>
                    <input type="text" class="form-control" id="station" name="station">
                </div>
                <div class="form-group">
                    <label for="email">Email：</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="tel">電話番号：</label>
                    <input type="text" class="form-control" id="tel" name="tel" required>
                </div>
                <div class="form-group">
                    <label for="fax">FAX番号：</label>
                    <input type="text" class="form-control" id="fax" name="fax">
                </div>
                <div class="form-group">
                    <label for="teacher">担当の先生名：</label>
                    <input type="text" class="form-control" id="teacher" name="teacher">
                </div>
                <div class="form-group">
                    <label>授業希望日[複数選択可]：<br>
                        <input type="checkbox" name="schedule[]" value="11月中">11月中<br>
                        <input type="checkbox" name="schedule[]" value="12月中">12月中<br>
                        <input type="checkbox" name="schedule[]" value="１月中">１月中<br>
                        <input type="checkbox" name="schedule[]" value="２月中">２月中<br>
                        <input type="checkbox" name="schedule[]" value="３月中">３月中<br>
                        <input type="checkbox" name="schedule[]" value="オンライン授業可">オンライン授業可
                    </label><br>
                </div>
                <div class="form-group">
                    <label for="soroteacher">希望の講師：</label>
                    <input type="text" class="form-control" id="soroteacher" name="soroteacher">
                </div>
                <div class="form-group">
                    <label for="content">その他ご要望：</label>
                    <textarea id="content" name="content" class="form-control" rows="4" cols="40"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">送信</button>
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>