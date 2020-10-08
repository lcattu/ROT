<?php 

session_start();
require('../function.php');

if(!isset($_SESSION['join'])){
  //  joinにセッションがissetされてない場合

  header('Location: index.php');
  //  上記の条件(SESSIONに情報方ない)の場合
  //  強制的にindex.phpに戻す処理
  //  例えばURLを直接入力し、check.phpにアクセスした場合
  //  $_SESSSIONに情報がない状態なので強制的に、index.phpにもどす処理
  exit();
}

if(isset($_SESSION['join'])){
  echo 'joinにデータありますよ！！';
}

if(!empty($_POST)){
  $statement = $db->prepare('INSERT INTO users SET user_name=?,mail=?, password=?, certify_password=?, created_at=NOW()');
  $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['password']),
    sha1($_SESSION['join']['certify_password'])

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


  <div class=" c-welcomeWrapper" style="display:block;">
    <div class="c-modalWrapper" >
      <div class="c-modal__body p-modal__body active">
        <h3 class="p-modal__body--title">#3 確認画面</h3>
        <form action="" method="post" >

          <input type="hidden" name="action" value="submit" />
          <dl class="">
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
            <a href="index.php?action==rewrite">&laquo; &nbsp; 書き直す</a>|<input type="submit" value="登録する">
            
          </div>
        </form>

          
      </div>  
    </div>
          
  </div>
</body>
<?php require"../footer.php" ?>