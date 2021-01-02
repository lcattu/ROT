<?php


debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログインページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();
 if(isset($_POST['login'])){
    if(!empty($_POST)){

      $email = $_POST['l_email'];
      $password = $_POST['l_password'];
      $save = $_POST['save'];
    

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
          $sql = 'SELECT  id, password FROM users WHERE mail=:l_email';
          $data = array(':l_email' => $email );
          
          //debug-----------------------------------------
          debug('★$dataの中身：'.print_r($data,true));


          // クエリ実行
          $stmt = queryPost($dbh, $sql, $data);

          //debug-------------------------------------
          debug('★$stmt クエリ実行の中身：'.print_r($stmt,true));

          // クエリ結果の値を取得
          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          //debug--------------------------------------
          debug('$result クエリ実行の中身：'.print_r($result,true));

          //debug--------------------------------------
          debug('★★★$result[password] クエリ実行の中身：'.print_r($result['password'],true));

            //-------------------------------------------------
            //password_hash()とpassword_verify()の確認テスト
            //-------------------------------------------------

              /*
              echo'入力値<br>';
              var_dump($password);
              echo'<br>';
              echo'<br>';

              echo'array_shift($result)の内容<br>';

              var_dump(array_shift($result));
              echo'<br>';
              echo'<br>';

              echo'hash化されたパスワード';
              var_dump($result['password']);


              $hash = $result['password'];
              $hash_stl=settype(array_shift($result),"string");

              debug('★★★$hashの中身：'.print_r($hash,true));
              */

              //if文でhash化されたパスワードをテスト SQLよりfetchした暗号化し格納されたパスワード
              /*
              if($password == array_shift($result)){
                echo '<br>if文での真偽値：TRUE';
                echo '<br>'.gettype($password);
                echo '<br>'.gettype($hash);
                echo '<br>'.gettype($hash_stl);

              }else{
                echo '<br>if文での真偽値：FALSE';
                echo '<br>'.gettype($password);
                echo '<br>'.gettype($hash);
                echo '<br>'.gettype($hash_stl);
              }
              echo '<br>';
              */

              // password_verify()  DEMO CODE
              /*
              if(password_verify($password, array_shift($result))){
                echo '<br>999_TRUE';
              }else{
                echo '<br>999_FALSE';
                echo '<br>';

                debug(print_r($password,true));
                echo '<br>';
                debug(print_r($hash,true));
              }
              */


          // パスワード照合
          if(!empty($result) &&password_verify($password, $result['password'])){
            /*

            debug('パスワードがマッチしました。');

            
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['login_date'] = time();
            /*
            if(empty($_SESSION['login_date'])){
              debug('時間が空っぽです');
            }else{
              debug('時間は空っぽではありません');
              debug('★★★★★★$_SESSION[time] クエリ実行の中身：'.print_r($_SESSION['time'],true));
              
            }
            */

            debug('$_SESSION[user_id] クエリ実行の中身：'.print_r($_SESSION['user_id'],true));
            //debug------------------------------------
            debug('★★★★★★$_SESSION[time] クエリ実行の中身：'.print_r($_SESSION['time'],true));


            //ログイン有効期限（デフォルトを１時間とする）
            $sesLimit = 60*60;
            // ログイン日時を現在日時に更新
            $_SESSION['login_date'] = time();

            // // ログイン保持にチェックがある場合
            if($save){
            debug('ログイン保持にチェックがあります');
            // 	// ログイン有効期限を30日に
            $_SESSION['login_limit'] = $sesLimit * 24 * 30;
            }else{
            debug('ログイン保持にチェックはありません');
            //ログイン有効期限はデフォルトの1時間に
            $_SESSION['login_limit'] = $sesLimit;
            }
            
            // ユーザーIDを格納
            $_SESSION['user_id'] = $result['id'];
            
            debug('★セッションの中身：'.print_r($_SESSION,true));
            debug('トップページへ遷移');
            header("Location:index.php");

          }else{
            debug('★★★パスワードがアンマッチです。');
          }

        }catch(Exception $e){
          print('エラー発生：'. $e->getMessage());
          die();
        }    
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
              <input type="text" name="l_email"  value="<?php if(!empty ($_POST['l_email'])) echo $_POST['l_email']; ?>" />

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
              <input type="password" name="l_password"  value="<?php if(!empty ($_POST['l_password'])) echo $_POST['l_password'] ?>" />
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
 