<?php

/**------------------------------
  ログ出力設定
--------------------------------*/
//エラー表示/非表示の設定
ini_set('log_errors','on');

//ログの出力ファイルを指定
ini_set('error_log','php.log');


/**------------------------------
  デバッグ関数
--------------------------------*/
//デバッグフラグ
$debug_flg = true;
//デバッグログ関数
function debug($str){
  global $debug_flg;
  if(!empty($debug_flg)){
    error_log('デバッグ：'.$str);
  }
}

/*----------------------------
  画面表示処理開始ログ吐き出し関数
------------------------------*/
function debugLogStart(){
  debug('>>>>>>   >>>>>>>    >>>>>>>> 画面表示処理開始');
  debug('セッションID：'.session_id());
  debug('セッション変数の中身：'.print_r($_SESSION,true));
  debug('現在日時のタイムスタンプ：'.time());
  if(!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])){
  debug('ログイン期限日時タイムスタンプ：'.($_SESSION['login_date'] +
  $_SESSION['login_limit']));
  }
}


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

function validMatch($value1, $value2, $key){
  if($value1 !== $value2){
    global $error;
    $error[$key]='unmatch';
  }
}


/*------------------------
 DB接続
-------------------------*/
function dbConnect(){
  $dsn = 'mysql:dbname=rot;host=127.0.0.1;charset=utf8';
  $user = 'root';
  $password = '';
	$options = array(
		// SQL実行失敗時にはエラーコードのみ設定
		PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
		// デフォルトフェッチモードを連想配列形式に設定
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		// バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
		// SELECTで得た結果に対してもrowCountメソッドを使えるようにする
		PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );

  $dbh = new PDO($dsn, $user, $password, $options); 
  debug('$dbhの中身：'.print_r($dbh,true));

  return $dbh;
}



//  SQL実行関数
function queryPost($dbh, $sql, $data){
  //  クエリ作成
  $stmt = $dbh->prepare($sql);

  if(!$stmt->execute($data)){
    debug('クエリ失敗しました。');
		debug('失敗したSQL：'.print_r($stmt,true));
    return 0;
  }
  debug('クエリ成功');
  return $stmt;
}


/*
try{
  $db = new PDO('mysql:dbname=rot; host=127.0.0.1; charset=utf8', 'root', '');
  debug('DB接続OK');
}catch(PDOException $e){
 print('DB接続エラー:'.$e->getMessage());
}
*/


?>