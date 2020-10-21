<?php  
session_start();
// PHPを実行した後でも、セットした情報を覚えている特性をもつ


if(!empty($_POST)){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $certify_password = $_POST['certify_password'];

  

  //  文字数チェック
   // 最大値チェック
  validateMaxLen($name, 'name');

    // 最小値チェック
  validateMinLen($name, 'name');

  //  email形式チェック
  validateMailCheck($email, 'email');

  //  PW文字数チェック
  validatePwLength($password, 'password');

  // 未入力チェック
  validateRequired($name, 'name');
  validateRequired($email, 'email');
  validateRequired($password, 'password');
  validateRequired($certify_password, 'certify_password');
}



echo '$keyの中身//<br>';
var_dump($key);
echo '<br>';

echo '$error[$key]の中身//<br>';
var_dump($error[$key]);

?>

<div class="c-welcomeWrapper">
  <!--#0 p-greetingModal -->
  <div class="c-modalWrapper">

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
          next
        </div>
        
      </div>
    </div>


    <!-- #0 -->
    <div class=" c-modal__body p-modal__body">

      <h3 class="p-modal__body--title">#0 Greeting</h3>
      <p>はじめまして。カツノリです<br>Twitter風webアプリ完成しました。よろしかったら、遊んでみてください。</p> 
    </div>
  
    <!-- #1 -->
    <div class="c-modal__body p-modal__body">
      <h3 class="p-modal__body--title">個人情報取扱指針</h3>
        <div class="p-modal__body--txtArea">
        
          <?php include('privacy&policy.php'); ?>
        </div>
        <div class = p-modal__body--checkBtn>
          <input id="check" type="checkbox" >上記に同意する
        </div>
    </div>
<!-- △△△△△△△△ -->
    <!-- #2 -->
    <div class="c-modal__body  p-modal__body">
      <h3 class="p-modal__body--title">#2 登録画面</h3>
      <p>登録ボタンを追加していく</p> 
      <form action="" method="post" enctype="multipart/form-data">
        <dl>
          <dt>ニックネーム</dt>
          <dd>
            <input type="text" name="name" size="35" maxlength="255" value="<?php print$_POST['name']; ?>"
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

            <?php echo '<br>'; ?>
            <?php var_dump($blank); ?>
            <?php echo '<br>'; ?>

            <!-- ニックネーム入力に関するエラー文 -->
            <?php if($error['name']==='blank'):?>
              <p class ="error">ニックネームを入力してください</p>
            <?php endif; ?>
            <?php if($error['name']==='max'):?>
              <p class ="error">文字長すぎです</p>
            <?php endif; ?>
            <?php if($error['name']==='min'):?>
              <p class ="error">文字短すぎです</p>
            <?php endif; ?>


            <?php var_dump ($error['name']);  ?>

            
          </dd>

          <dt>メールアドレス</dt>
          <dd>
            <input type="text" name="email" size="35" maxlength="255"
            value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>"
            >
            
            <!-- ニックネーム入力に関するエラー文 -->
            <?php if($error['email']==='blank'):?>
              <p class ="error">メールアドレスを入力してください</p>
            <?php endif; ?>

            <?php if($error['email']==='check'):?>
              <p class ="error">正しくメールアドレスが入力されていないようです</p>
            <?php endif; ?>

          </dd>

          <dt>パスワード</dt>
          <dd>
            <input type="password" name="password"  size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES)); ?>">

            <?php if($error['password']==='blank'):?>
            <p class ="error">パスワードを入力してください</p>
            <?php endif; ?>

            <?php if($error['password']==='length'):?>
            <p class ="error">パスワードは4文字以上で入力してください</p>
            <?php endif; ?>
    

          </dd>

          <dt>パスワード(確認)</dt>
          <dd>
            <input type="password" name="certify_password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['certify_password'],ENT_QUOTES)); ?>">
          

          </dd>
          <?php if($error['certify_password'] ==='blank'): ?>
              <p class ="error">確認パスワードを入力してください</p>
            <?php endif; ?>

            <?php if($_POST['certify_password'] !== $_POST['password']): ?>
              <p class ="error">パスワードと確認パスワードが一致しません</p>
            <?php endif;?>
            

        </dl>
<!-- △△△△△△△△ -->

        <div>
          <input type="submit" value="入力内容を確認する" class="input-btn">
        </div>
      </form>
    </div>
  </div>
</div>

