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
        <form action="login_act.php" method="POST">
            <label for="lid">ID:</label>
            <input type="text" id="lid" name="lid" required>

            <label for="lpw">パスワード:</label>
            <input type="password" id="lpw" name="lpw" required>

            <button type="submit">ログイン</button>
        </form>
    </div>
</body>

</html>