<?php  

// PHPを実行した後でも、セットした情報を覚えている特性をもつ

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ユーザー登録ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


if(!empty($_POST['signup'])){

  $name = $_POST['s_name'];
  $email = $_POST['s_email'];
  $password = $_POST['s_password'];
  $certify_password = $_POST['certify_password'];

  
  //  文字数チェック
   // 最大値チェック
  validateMaxLen($name, 's_name');

    // 最小値チェック
  validateMinLen($name, 's_name');

  //  email形式チェック
  validateMailCheck($email, 's_email');

  //  PW文字数チェック
  validatePwLength($password, 's_password');

  // 未入力チェック
  validateRequired($name, 's_name');
  validateRequired($email, 's_email');
  validateRequired($password, 's_password');
  validateRequired($certify_password, 'certify_password');
  validMatch($password, $certify_password, 'certify_password');

  debug('$errorの中身:'.print_r($error, true));
  debug('$_POSTの中身:'.print_r($_POST, true));

  if(empty($error)){
    debug('$errorの中身:'.print_r($error,true));
    
    try{
      $dbh = dbConnect();

      //パスワードをハッシュ化したものを$hashに代入
      $hash = password_hash($password, PASSWORD_BCRYPT);

      $sql = 'INSERT INTO users (user_name,mail, password, created_at, updated_at) VALUES (:s_name, :s_email, :s_password, :login_time, :created_date)';

      //$dataに自分が定義したname属性をキー、$_POSTを代入している変数を要素とする配列を代入
      $data = array(
        ':s_name'=>$name,
        ':s_email'=>$email,
        ':s_password'=>$hash,
        ':login_time' => date('Y-m-d H:i:s'), 
        ':created_date' => date('Y-m-d H:i:s')
      );
      //debug----------------------------------
      debug('dataの中身：'.print_r($data,true));


      //クエリ実行
      $stmt = queryPost($dbh, $sql, $data);

      if(isset($stmt)){




        header("Location:join_thanks.php");
       }
   }catch(Exeption $e){
      print("DB接続エラー:".$e->getMessage());

    }

  }
}



?>
<!-- samplemodal -->
<div class="c-welcomeWrapper">

  <!-- samplemodal-wrap -->
  <div class="c-modalWrapper">

    <!-- samplemodal-bg -->
    <div class="c-modalWrapper__bg">&nbsp;</div>
    
    <!-- samplemodal-box -->
    <div class="c-modalWrapper__box">
    <div class="p-modal__btnWrapper">
        <div class="p-closeBtn">
          <i class="fa fa-2x fa-times"></i>
        </div>

        <div class="p-change-btn  p-prev-btn">
          <div class="p-modal__turnIcon">
            <i class ="fa fa-chevron-left fa-2x"></i>
            <p>prev</p>
          </div>
        </div>

        
        <div class="p-change-btn p-next-btn " >
          <div class="p-modal__turnIcon">
            <i class="fa fa-chevron-right fa-2x"></i>
            <p>next</p>
          </div>
          
        </div>

        <div class="p-alter-btn ">
          <div class="p-modal__turnIcon">
            <i class="fa fa-chevron-right fa-2x"></i>
            <p>next</p>
          </div>
          
        </div>
      </div>
    <!--inner  -->

      <!-- #0 -->
      <div class=" c-modal__body p-modal__body">

        <h4 class="p-modal__body--title">#0 Greeting</h4>
        <p>はじめまして。カツノリです<br>Twitter風webアプリ完成しました。よろしかったら、遊んでみてください。</p> 
      </div>
    
      <!-- #1 -->
      <div class="c-modal__body p-modal__body">
        <h4 class="p-modal__body--title">個人情報取扱指針</h4>
          <div class="p-modal__body--txtArea">
          
            <?php include('privacy&policy.php'); ?>
          </div>
          <div class = p-modal__body--checkBtn>
            <input id="check" type="checkbox" >上記に同意する
          </div>
      </div>

      <!-- #2 -->
      <div class="c-modal__body  p-modal__body">
        <h4 class="p-modal__body--title">#2 登録画面</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <dl>
            <dt>ニックネーム</dt>
            <dd>
              <input type="text" name="s_name" value="<?php if(!empty ($_POST ['s_name'])) echo $_POST['s_name']; ?>"
              >

              <!-- 
                ♦htmlspecialcharsﾌｧﾝｸｼｮﾝ
                htmlspecialcharsﾌｧﾝｸｼｮﾝを使うことで、HTMLﾀｸﾞの効果を打ち消して、イタズラのようなコードを無効化する

                ♦ENT_QUOTES
                「定義済みの定数」
                これを指定することで
                  - 「"」が&quot;
                  - 「’」が&#039 or &apos;
                  - 「<」が &lt;
                  - 「>」が &gt;
                以上に変換される

                参考URL(https://www.leon-tec.co.jp/blog/yoshida/8214/)
              --> 

              
              <!-- ニックネーム入力に関するエラー文 -->
              <?php if($error['s_name']==='blank'):?>
                <p class ="signup__error">ニックネームを入力してください</p>
              <?php endif; ?>
              <?php if($error['s_name']==='max'):?>
                <p class ="signup__error">文字長すぎです</p>
              <?php endif; ?>
              <?php if($error['s_name']==='min'):?>
                <p class ="signup__error">文字短すぎです</p>
              <?php endif; ?>



              
            </dd>

            <dt>メールアドレス</dt>
            <dd>
              <input type="text" name="s_email" 
              value="<?php if(!empty ($_POST['s_email'])) echo $_POST['s_email']; ?>"
              >
              
              
              <!-- ニックネーム入力に関するエラー文 -->
              <?php if($error['s_email']==='blank'):?>
                <p class ="signup__error">メールアドレスを入力してください</p>
              <?php endif; ?>

              <?php if($error['s_email']==='check'):?>
                <p class ="signup__error">正しくメールアドレスが入力されていないようです</p>
              <?php endif; ?>

            </dd>

            <dt>パスワード</dt>
            <dd>
              <input type="password" name="s_password" value="<?php if(!empty ($_POST['s_password'])) echo $_POST['s_password']; ?>">

              <?php if($error['s_password']==='blank'):?>
              <p class ="signup__error">パスワードを入力してください</p>
              <?php endif; ?>

              <?php if($error['s_password']==='length'):?>
              <p class ="signup__error">パスワードは4文字以上で入力してください</p>
              <?php endif; ?>
            </dd>

            <dt>パスワード(確認)</dt>
            <dd>
              <input type="password" name="certify_password" value="<?php if(!empty ($_POST['certify_password'])) echo $_POST['certify_password']; ?>">
            </dd>
              <?php if($error['certify_password'] ==='blank'): ?>
                <p class ="signup__error">確認パスワードを入力してください</p>
              <?php endif; ?>

              <?php if($error['certify_password']==='unmatch'): ?>
                <p class ="signup__error">パスワードと確認パスワードが一致しません</p>
              <?php endif;?>
              

          </dl>

          <div>
            <input type="submit" name="signup" value="入力内容を確認する" class="input-btn">
            <!-- <input type="submit" value="入力内容を確認する" class="input-btn"> -->
          </div>
        </form>
      </div>


    </div>





  </div>
</div>