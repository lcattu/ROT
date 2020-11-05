<?php
session_start();

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログインページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();
 if(isset($_POST['login'])){
    if(!empty($_POST)){

      $email = $_POST['l_email'];
      $password = $_POST['l_password'];
    

      // 未入力チェック
      validateRequired($email, 'l_email');
      validateRequired($password, 'l_password');
      
      if(empty($error)){
        //  email形式チェック
        validateMailCheck($email, 'l_email');

        //  PW文字数チェック
        validatePwLength($password, 'l_password');


        
        try{
          // DB接続
          $dbh = dbConnect();
          $sql = 'SELECT password FROM users WHERE mail=:l_email';
          $sth = $dbh->prepare($sql);
          
          
            debug('$sql実行の中身：'.print_r($sql,true));
            debug('$sth実行の中身：'.print_r($sth,true));
            
          $sth->bindParam(':l_email',$email);
          $sth->execute();
          $hash = settype($sth->fetch(), "string");

          /*          
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);
            debug('$stmt クエリ実行の中身：'.print_r($stmt,true));

            // クエリ結果の値を取得
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            debug('$result クエリ実行の中身：'.print_r($result,true));

            //  SQLから取り出したパスワードを、$hashに代入
            $hash = substr($result['password'],0,60);
            debug('★$hash クエリ実行の中身：'.print_r($hash,true));
            debug('★$password クエリ実行の中身：'.print_r($password,true));
          */  

          //入力値として
          var_dump($password);

          //SQLよりfetchした暗号化し格納されたパスワード
          var_dump($hash);

          if($password == $hash){
            echo '成功';
          }else{
            echo '失敗';
          }
          echo '<br>';
          echo mb_strlen($hash);


          // パスワード照合
          if(password_verify($_POST['l_password'], $hash)){
            debug('パスワードがマッチしました。');

            //ログイン有効期限（デフォルトを１時間とする）
            // $sesLimit = 60*60;
            // ログイン日時を現在日時に更新
            // $_SESSION['login_date'] = time();

            // // ログイン保持にチェックがある場合
            // if($pass_save){
            // 	debug('ログイン保持にチェックがあります');
            // 	// ログイン有効期限を30日に
            // 	$_SESSION['login_limit'] = $sesLimit * 24 * 30;
            // }else{
            // 	debug('ログイン保持にチェックはありません');
            // 	// ログイン有効期限はデフォルトの1時間に
            // 	$_SESSION['login_limit'] = $sesLimit;
            // }
            
            // ユーザーIDを格納
            $_SESSION['user_id'] = $result['id'];
            
            debug('★セッションの中身：'.print_r($_SESSION,true));
            debug('トップページへ遷移');
            header("Location:../index.php");
          }else{
            debug('パスワードがアンマッチです。');
          }
        }catch(Exception $e){
          print('エラー発生：'. $e->getMessage());
          die();
        }    
      

        
        // if ($_POST['l_email'] !== '' && $_POST['l_passward'] !==''){
        //   $login = $db->prepare('SELECT * FROM users WHERE mail=? AND password=?');
        //   debug('loginの中身'.print_r($login,true));
        //   debug('$dbの中身'.print_r($db,true));

        //   $login->execute(array(  
        //     $_POST['l_email'],
        //     sha1($_POST['l_password'])
        //     // 入力したパスワードを再度暗号化して登録されたものと照合する
        //   ));
          
        //   $member = $login -> fetch();
        //   debug('$memberの中身：'.print_r($member,true));


        //   if($member){
        //     $_SESSION['id'] = $member['id'];
        //     $_SESSION['time'] = time();

        //     //クッキーにメールアドレスを保存
        //     /* 
        //     if($_POST['save']==='on'){
        //       setcookie('email',$_POST['email'],time()+60*60*24*14);
        //     } 
        //     */
        //     header('Location: ../index.php');
        //     debug('ログイン成功');
        //     exit();
        //   }else{
        //     $error['login'] = 'failed';
        //     debug('ログイン失敗');          
        //     debug('$memberの中身：'.print_r($member,true));

        //   }
                  
        // }else{
        //   $error['login'] = 'blank';
        // }
        
      
        //エラーメッセージを出す仕様にする  
        

      }
      
    }
}




?>

<!-- sample modal -->
<div class="c-loginWrapper">

  <!-- sample modal-wrap -->
  <div class="c-modalWrapper">

    <!-- samplemodal-bg -->
    <div class="c-modalWrapper__bg">&nbsp;</div>
    
    <!-- samplemodal-box -->
    <div class=" c-modalWrapper__box">
      
      <!-- inner -->
      <div class="c-modal__regiBody p-modal__body">
        <div class="p-closeBtn">
          <i class="fa fa-2x fa-times"></i>
        </div>
        <h4 class="p-modal__body--title">hogehoge</h4>
        <form action="" method="post">
          <dl>

            <dt>メールアドレス</dt>
            <dd>
              <input type="text" name="l_email" size="35" maxlength="255" value="<?php if(!empty ($_POST['l_email'])) echo htmlspecialchars($_POST['l_email'],ENT_QUOTES); ?>" />

              <!-- エラーメッセージ -->
              <!-- ニックネーム入力に関するエラー文 -->
              <?php if($error['l_email']==='blank'):?>
                <p class ="login__error">メールアドレスを入力してください</p>
              <?php endif; ?>

              <?php if($error['l_email']==='check'):?>
                <p class ="login__error">正しくメールアドレスが入力されていないようです</p>
              <?php endif; ?>


            </dd>
            <dt>パスワード</dt>
            <dd>
              <input type="password" name="l_password" size="35" maxlength="255" value="<?php if(!empty ($_POST['l_password'])) echo htmlspecialchars($_POST['l_password'],ENT_QUOTES); ?>" />
            </dd>
            <!-- エラーメッセージ -->
            <?php if($error['l_password']==='blank'):?>
            <p class ="login__error">パスワードを入力してください</p>
            <?php endif;?>

            <?php if($error['l_password']==='length'):?>
            <p class ="login__error">パスワードは4文字以上で入力してください</p>
            <?php endif;?>



            <dt>ログイン情報の記録</dt>
            <dd>
              <input id="save" type="checkbox" name="save" value="on">
              <label for="save">次回からは自動的にログインする</label>
            </dd>
          </dl>
          <div>
            <input type="submit" name="login" value="ログインする" />
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
 