<?php

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　★★★編集　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証
require('auth.php');

/*-------------------------------
	画面処理
-------------------------------*/
//DBからユーザーデータを取得

$dbFormData = getUser($_SESSION['user_id']);
debug('$dbFormData--情報：'.print_r($dbFormData,true));

//$_POSTにデータがあった場合の処理
if(!empty($_POST)){
	debug('post送信があります。');	
	debug('post情報：'.print_r($_POST,true));

	$username = $_POST['username'];
	$mail = $_POST['mail'];

	//	画像アップロード・パスを格納
	$user_img = (!empty($_FILES['user_img']['name']))?uploadImg($_FILES['user_img'],'user_img'):'';

	//	DBに画像をデフォルト登録してあることが前提？
	//	NO→ユーザー登録時にデフォルト登録してあるのかも
	// 画像をpostしなかった場合、既にDBに登録されていたらDBのパスを入れる
	//とりあえず現段階では、保留
	//$user_img = (empty($user_img) && !empty($dbFormData['user_img'])) ? $dbFormData['user_img'] : $user_img;



	//バリデーションチェック　現時点で略


	//	バリデーションチェック終了後
	if(empty($error)){
		debug('バリデーションOKです。');

		try{
			// DBへ接続
			$dbh = dbConnect();
			// SQL文作成
			$sql = 'UPDATE users SET user_name = :u_name, mail = :mail, user_img = :user_img WHERE id = :u_id ';

			$data = array(':u_name' => $username, ':mail'=>$mail, ':user_img'=>$user_img, ':u_id'=>$dbFormData['id'] );
			
			// クエリ実行
			$stmt = queryPost($dbh, $sql, $data);

			// クエリ成功の場合
			if($stmt){
				debug('成功しました');
				debug('マイページへ遷移します。');
				header("Location:user_proFile.php?u_id=".$_SESSION['user_id']);
			}else{
				debug('変更登録失敗');
			}

		}catch(Exception $e){
			error_log('エラー発生：'.$e->getMessage());
		}
	}
}



debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');


?>


<form action="" method="post" class="form" enctype="multipart/form-data">
	<h2>プロフィールを編集</h2>
	<div class="form-wrap">
		<div class="err_msg">
		</div>

			<!-- 画像データの編集 -->
			<label class ="u_Editpic">
				<!-- クラス名(仮) -->
				<i class="far fa-user fa-3x"></i>
				<input type="hidden">

				<input type="file" name="user_img" class="user_picture">

			</label>


			<label class="">
				ユーザー名
				<input type="text" name="username" value="<?php echo getFormData('user_name'); ?>">
			</label>
			<label class="">
				メールアドレス
				<input type="text" name="mail" value="<?php echo getFormData('mail'); ?>">
			</label>


			<input type="submit" class="btn-primary btn-mid" value="保存">
	</div>
	<div>
	</div>
</form>
