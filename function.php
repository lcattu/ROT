<?php
/*----------------------------
 グローバル変数
------------------------------*/
$error = array();

/*----------------------------
 バリデーションチェック
------------------------------*/

// 未入力チェック
function validateRequired($value, $key){
  if($value===''){
    
    global $error;
    $error[$key] ='blank';
    var_dump($error);
  }
}

//  最大文字数チェック
function validateMaxLen($value, $key, $max=200){
  //  
  $value = str_replace("\r\n","", $value);
  if(mb_strlen($value) > $max){
    global $error;
    $error[$key] = 'max';
  }
}

// 最小文字数チェック
function validateMinLen($value, $key, $min=2){
 if(mb_strlen($value) < $min){
  global $error;
  $error[$key] = 'min';
 }
}

//  email形式チェック
function validateMailCheck($value, $key){
  if(filter_var($value, FILTER_VALIDATE_EMAIL)){
  }else{
    global $error;
    $error[$key]='check';
  }
}

//  PWチェック
function validatePwLength($value, $key){
  if(strlen($value)<4){
    global $error;
    $error[$key]='length';
  }
}



/**
 * 入力チェック
*/
/*
if(!empty($_POST)){
  // 「空でない=!empty」
  //  $_POSTが空でないことを確認し、ﾌｫｰﾑが送信されたことを確認
  //  例えば何も記述されていない状態で再読み込みされた場合にエラーメッセージを出力しないようにする


	

  
  

  if(empty($error)){
    //  上記の$error配列が空であるかを確認
    //  True 空の場合…セッションに値を保存
    //  次の画面に推移

    $_SESSION['join'] = $_POST;
    header('Location:check.php');
  }


}
*/  





/*------------------------
 DB接続
-------------------------*/
try{
  $db = new PDO('mysql:dbname=rot; host=127.0.0.1; charset=utf8', 'root', '');
}catch(PDOException $e){
  print('DB接続エラー:'.$e->getMessage());
}



?>