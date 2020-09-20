<?php
session_start();

require('../dbconnect.php');

if(!empty($_POST)){

}


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
    exit();
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
  <?php require "join_header.php" ?>

  <h1>Replication of Twitter</h1>


  <div class="p-welcomeWrapper">

        <!--#0 p-greetingModal -->
      <div class="c-modal">
          <!-- change-btn-wrapper -->
          <div class="c-modal__footer">
            <div class="change-btn prev-btn">
              <div class="icon">
                <i class ="fa fa-chevron-left fa-2x"></i>
                <br>
                <p>prev</p>
              
              </div>
              
            </div>

            
            <div class="change-btn next-btn " >
              <div class="icon">
                <i class="fa fa-chevron-right fa-2x"></i>
                <br>
                <p>next</p>
              </div>
              
            </div>

            <div class="alter-btn ">
              <div class="icon">
                <i class="fa fa-chevron-right fa-2x"></i>
                <br>
                next
              </div>
              
            </div>
          </div>
          <div class="c-welcomeWrapper">
            <!-- #0 -->
            <!-- !!!!デフォルトactiveｸﾗｽが入ってるやつ -->
            <div class=" c-modal__body active">

            <h3 class="c-modal__title">#0 Greeting</h3>
            <p>はじめまして。カツノリです<br>Twitter風webアプリ完成しました。よろしかったら、遊んでみてください。</p> 
          </div>
          
          <!-- #1 -->
          <div class="c-modal__body">
            <h3 class="c-modal__title">#1 プライバシーポリシー</h3>
            <p>約束してちょ</p>
            <input id="check" type="checkbox" >上記に同意する

            </div>

          <!-- #2 -->
          <div class="c-modal__body ">
            <h3 class="c-modal__title">#2 登録画面</h3>
            <p>登録ボタンを追加していく</p> 
            <form action="" method="post" enctype="multipart/form-data">
              <dl>
                <dt>ニックネーム</dt>
                <dd>
                  <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES)); ?>"
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

                  <?php if($error['name'] =='blank'):?>
      						<p class ="error">ニックネームを入力してください</p>
					        <?php endif; ?>


                </dd>

                <dt>メールアドレス</dt>
                <dd>
                  <input type="text" name="email" size="35" maxlength="255"
                  value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>"
                  >

                  <?php if($error['email']==='blank'):?>
                    <p>メールアドレスを入力してください</p>
                  <?php endif; ?>

                  <?php if($error['email']='check'):?>
                    <p>正しくメールアドレスが入力されていないようです</p>
                  <?php endif; ?>
                  
                </dd>

                <dt>パスワード</dt>
                <dd>
                  <input type="password" name="password"  size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES)); ?>">

                  <?php if($error['password']==='blank'):?>
						      <p>パスワードを入力してください</p>
					        <?php endif; ?>
					        <?php if($error['password']==='length'):?>
						      <p>パスワードは4文字以上で入力してください</p>
					        <?php endif; ?>
					

                </dd>

                <dt>パスワード(確認)</dt>
                <dd>
                  <input type="password" name="certify_password"  size="10" maxlength="20" value="
                  <?php print(htmlspecialchars($_POST['certify_password'], ENT_QUOTES)); ?>
                  ">
                </dd>
                <?php if($error['certify_password'] ==='blank'): ?>
						      <p>確認パスワードを入力してください</p>
					      <?php endif; ?>

                <?php if($_POST['certify_password'] !== $_POST['password']): ?>
                <?php $error['certify_password'] = 'check' ?>
                
                  <p>パスワードと確認パスワードが一致しません</p>
                <?php endif;?>

                


              </dl>
              <div>
                <input type="submit" value="入力内容を確認する">
              </div>
            </form>

          </div>

          <!-- #3 -->

          <!-- #4 -->


        </div>

    </div>
  </div>


  <script src="../script.js"></script>
</body>

<?php require"../footer.php" ?>