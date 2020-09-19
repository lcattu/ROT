<?php 

session_start();
require('../dbconnect.php');

if(!isset($_SESSION['join'])){
  //  joinにセッションがissetされてない場合

  header('Location: index.php');
  //  上記の条件(SESSIONに情報方ない)の場合
  //  強制的にindex.phpに戻す処理
  //  例えばURLを直接入力し、check.phpにアクセスした場合
  //  $_SESSSIONに情報がない状態なので強制的に、index.phpにもどす処理
  exit();
}

if(!empty($_POST)){
  $statement = $db->prepare('INSERT INTO users SET user_name=?,mail=?, created_at=NOW()');
  $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email']
    
	));
	unset($_SESSION['join']);

	header('Location: thanks.php');
	exit();
}



?>



<?php require "../head.php"; ?>
<body>
  <!-- ヘッダー -->
  <?php require "join_header.php" ?>

  <h1>Replication of Twitter</h1>


  <div class=" p-welcomeWrapper">
    <div class="c-modal">
      <div class="c-welcomeWrapper">
      <div class="c-modal__body active">
            <h3 class="mt-5 c-modal__title">#3 確認画面</h3>
            <p>登録ボタンを追加していく</p> 
            <form action="" method="post" >

              <input type="hidden" name="action" value="submit" />
              <dl class="mt-5">
                <dt>ニックネーム</dt>
                <dd>
                  <?php echo(htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES)); ?>
                </dd>

                <dt>メールアドレス</dt>
                <dd>
                  <?php echo(htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES)); ?>

                </dd>

                <dt>パスワード</dt>
                <dd>
                  【表示されません】
                </dd>
              </dl>

              <div>
                <a href="index.php?action=rewrite">&laquo; &nbsp; 書き直す</a>|<input type="submit" value="登録する">
                
              </div>
            </form>

          </div>
      </div>  
    </div>
          
  </div>
</body>
<?php require"../footer.php" ?>