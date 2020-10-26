<?php  
session_start();
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
              <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($email , ENT_QUOTES)); ?>" />

              <!-- エラーメッセージ -->
              <?php if($error['login'] === 'blank'): ?>
                <p class="">*メールアドレスとパスワードをご記入ください</p>
              <?php endif; ?>

              <?php if($error['login'] === 'failed'): ?>
                <p class="">*ログインに失敗しました。正しくご記入ください</p>
              <?php endif; ?>


            </dd>
            <dt>パスワード</dt>
            <dd>
              <input type="password" name="password" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['password'] , ENT_QUOTES)); ?>" />
            </dd>
            <dt>ログイン情報の記録</dt>
            <dd>
              <input id="save" type="checkbox" name="save" value="on">
              <label for="save">次回からは自動的にログインする</label>
            </dd>
          </dl>
          <div>
            <input type="submit" value="ログインする" />
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
 