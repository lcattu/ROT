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
  セッションについて
------------------------------*/
session_start();

session_regenerate_id();



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

//DB接続関数
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

//  ユーザー情報取得
function getUser($u_id){
	debug('ユーザー情報を取得します。');
	try{
		$dbh = dbConnect();
		$sql = 'SELECT * FROM users WHERE id = :u_id';
		$data = array(':u_id' => $u_id);
		// クエリ実行
		$stmt = queryPost($dbh, $sql, $data);
    debug('getUser関数が成功');

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
      debug('getUser関数が失敗');

      return false;
      
		}
	}catch(Exception $e){
		error_log('エラー発生：'.$e->getMessage());
	}
}

//  投稿情報を取得
function getPost($users_u_id, $posts_p_id){
	debug('投稿情報を取得します。');
	debug('ユーザID：'.$posts_u_id);
	debug('投稿ID：'.$posts_p_id);

	try{
		$dbh = dbConnect();
		$sql = 'SELECT * FROM posts WHERE user_id = :u_id AND id = :p_id';
		$data = array(':u_id' => $posts_u_id, ':p_id' => $posts_p_id);

		// クエリ実行
		$stmt = queryPost($dbh, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}catch(Exception $e){
		error_log('エラー発生：'.$e->getMessage());
	}
}


/*
try{
  $db = new PDO('mysql:dbname=rot; host=127.0.0.1; charset=utf8', 'root', '');
  debug('DB接続OK');
}catch(PDOException $e){
 print('DB接続エラー:'.$e->getMessage());
}
*/

//  サニタイズ
function sanitize($str){
  return htmlspecialchars($str, ENT_QUOTES);
}


//  フォームの入力保持
function getFormData($str, $flg=false){
  debug('getFormData発火します');
  if($flg){
    $method = $_GET;
    debug('$_GETを$methodに代入');
  }else{
    $method = $_POST;
    debug('$_POSTを$methodに代入');
  }
  debug('getFormData内の$methodの中身'.print_r($method,true));

  global $dbFormData;
  


  //  1 ユーザーデータがある場合
  if(!empty($dbFormData)){
    debug('1 ユーザーデータがある場合');

    // 保留：2 フォームのエラーがある場合
    if(!empty($error[$str])){
      debug('2 フォームのエラーがある場合');

      //保留：3 POSTにデータがある場合
      //疑問？？  なぜ＄＿GETではないのか？
      if(isset($method[$str])){
        debug('3 POSTにデータがある場合');
        return $method[$str];
      }else{
        return $dbFormData[$str];
      }
    } else{
      //  2-else POSTにデータがあり、DBの情報と違う場合
      debug('POSTにデータがあり、DBの情報と違う場合');

      if(isset($method[$str]) && $method[$str] !== $dbFormData[$str]){
        //違っていた場合の処理→POST送信
        debug('POSTにデータがあり、DBの情報と違う場合 if内のture処理');
				return $method[$str];
			}else{
        //POSTにデータがあり、DBの情報($_GETで取得した情報と)
        //同じだった場合
        debug('変更しない');
        return $dbFormData[$str];
      }
      debug('!empty($dbFormData)の条件を通過');
    }
  }else{
    if(isset($method[$str])){
			return sanitize($method[$str]);
    }
  }
}

//  画像処理
function uploadImg($file, $key){
  debug('画像アップロード処理開始');
  debug('FILE情報：'.print_r($file,true));
  
  
}

?>