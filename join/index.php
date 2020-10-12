<?php
session_start();

require('../function.php');

if($_REQUEST['action']=='rewrite' && isset($_SESSION['join'])){
  //  check.phpから『書き直す』をクリックした際
  //  URLﾊﾟﾗﾒｰﾀｰにrewriteがついていた場合

  $_POST = $_SESSION['join'];

}
?>

<?php require "../head.php"; ?>
<body>
  <!-- ヘッダー -->
  <?php require "join_header.php"; ?>

  <h1>Replication of Twitter</h1>
  <!-- テスト -->
  <div class="p-startBtn">
  <a>登録</a>
  </div>

  <div class="p-loginBtn">
  <a>ログイン</a>
  </div>

  <?php require'join_c-loginWrapper.php'?>


  <?php require'join_c-welcomeWrapper.php' ?>


  <script src="../script.js"></script>
</body>

<?php require"../footer.php" ?>