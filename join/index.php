<?php
session_start();

require('../dbconnect.php');



/**
 * 入力チェック
*/

if(!empty($_POST)){
  // 「空でない=!empty」
  //  $_POSTが空でないことを確認し、ﾌｫｰﾑが送信されたことを確認
  //  例えば何も記述されていない状態で再読み込みされた場合にエラーメッセージを出力しないようにする

  if($_POST['name']===''){
    //  print('名前が入力されていません');
    
    $error['name']='blank';
    //  $errorという配列の'name'キーに対し'blank'という値を代入
	}



	if($_POST['email']===''){
		//print('名前が入力されていません');
		$error['email']='blank';
  }

  if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  }else{
    $error['email']='check';
  }

	if(strlen($_POST['password'])<4){
    //「strlen」ファンクションで確認し、4文字以下である場合は「length」というエラーとして記録

		//print('名前が入力されていません');
		$error['password']='length';
  }
  
  if($_POST['password']===''){
    $error['password']='blank';
  }


  if($_POST['certify_password'] === ''){
    $error['certify_password'] = 'blank';
  }

  

  if(empty($error)){
    //  上記の$error配列が空であるかを確認
    //  True 空の場合…セッションに値を保存
    //  次の画面に推移

    $_SESSION['join'] = $_POST;
    header('Location:check.php');
  }


  

}





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

  <div class="startBtn">
  <a>登録</a>
  </div>

  <div class="loginBtn">
  <a>ログイン</a>
  </div>

  <div class="c-loginWrapper">
    <div class="c-modalWrapper">
      <div class="p-closeBtn">
        <i class="fa fa-2x fa-times"></i>
      </div>
      <div class="c-modal__regiBody">
        <h1>hogehoge</h1>
      </div>
    </div>
  </div>
  
  <?php require'join_c-welcomeWrapper.php'?>



  <script src="../script.js"></script>
</body>

<?php require"../footer.php" ?>