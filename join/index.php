<?php

session_start();

require('../function.php');

if($_REQUEST['action']=='rewrite' && isset($_SESSION['join'])){
  //  check.phpから『書き直す』をクリックした際
  //  URLﾊﾟﾗﾒｰﾀｰにrewriteがついていた場合

  $_POST = $_SESSION['join'];

}else{
}
?>

<?php require "../head.php"; ?>
<body>
  <!-- ヘッダー -->
  <?php require "join_header.php"; ?>

  <div class="container-sm">
    <h1>Replication of Twitter</h1>

    <div class="btn-btn-wrawrapper">
      <div class="p-startBtn">
        <a>登録</a>
      </div>
      <div class="p-loginBtn">
        <a>ログイン</a>
      </div>

    </div>
    <pre>
      <?php

        // $array = [
        //   [‘田中’,25,’女性’],
        //   [‘樋口’,32,’男性’],
        //   [‘山本’,16,’女性’]
        // ];

        echo $array;
      
      ?>
    </pre>

    
  
  </div>

  
  <?php require'join_c-loginWrapper.php'?>


  <?php require'join_c-welcomeWrapper.php' ?>


  <script src="../script.js"></script>
</body>

<?php require"../footer.php" ?>