<?php

/*----------------------------
 バリデーションチェック
------------------------------*/



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
/*------------------------
 DB接続
-------------------------*/
try{
  $db = new PDO('mysql:dbname=rot; host=127.0.0.1; charset=utf8', 'root', '');
}catch(PDOException $e){
  print('DB接続エラー:'.$e->getMessage());
}



?>