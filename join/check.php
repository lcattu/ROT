<?php 

session_start();
require('../dbconnect.php');

if(!isset($_SESSION['join'])){
  header('Location: index.php');
  exit();
}

if(!empty($_POST)){
	$statement = $db->prepare('INSERT INTO users SET user_name=?, email=?, password=?, created=NOW(), update_at=NOW()');
	$statement->execute(array(
		$_SESSION['join']['user_name'],
		$_SESSION['join']['email'],
		sha1($_SESSION['join']['password']),
	));
	unset($_SESSION['join']);

	header('Location: thanks.php');
	exit();
}



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="c-modal__body">
  <h3 class="c-modal__title">#2 登録画面</h3>
  <p>登録ボタンを追加していく</p> 
  <form action="" method="post" enctype="multipart/form-data">

  <input type="hidden" name="action" value="submit" />
  <dl>
    <dt>ニックネーム</dt>
    <dd>
      <?php echo htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES); ?>
    </dd>

    <dt>メールアドレス</dt>
    <dd>
      <?php echo htmlspecialchars($_SESSION['join']['email'],ENT_QUTES); ?>

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
</body>
</html>


