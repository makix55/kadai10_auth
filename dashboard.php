<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

echo "ようこそ、" . $_SESSION["username"] . "さん！<br>";

if ($_SESSION["kanri_flg"] == 1) {
    echo "<a href='admin.php'>管理者ページ</a><br>";
} else {
    echo "※ 閲覧のみ可能です<br>";
}
