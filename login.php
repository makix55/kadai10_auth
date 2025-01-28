<!DOCTYPE html>
<html>

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

        <body>

            <header>
                <nav class="navbar navbar-default">LOGIN</nav>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="index.php">データ登録</a>
                        </div>
                    </div>
                </nav>
            </header>
            <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
            <form name="form1" action="login_act.php" method="post">
                ID:<input type="text" name="lid" />
                PW:<input type="password" name="lpw" />
                <input type="submit" value="LOGIN" />
            </form>


        </body>

</html>