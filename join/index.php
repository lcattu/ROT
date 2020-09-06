<?php require "../head.php"; ?>
<body>
  <!-- ヘッダー -->
  <?php require "join_header.php" ?>



  <div id="head">
    <h1>会員登録</h1>
  </div>
  <div id="content">
    <p>次のフォームに必要事項をご記入ください</p>
    <form action="" method="" enctype="multipqrt/form-data">
    <dl>
      <dt>ユーザー名<span></span></dt>
      <dd>
        <input type="text" name="name" size="35" maxlength="255" value="">

      </dd>


      <dt>メールアドレス</dt>
      <dd>
      <input type="text" name="email" size="35" maxlength="255" value="">
      </dd>

      <dt>パスワード</dt>
      <dd>
        <input type="password" name="password" size="10" maxlength="20" value="">
      </dd>
    </dl>
    <div>
      <input type="submit" value="入力内容を確認する">
    </div>
    </form>
  </div>
</body>
<?php require"../footer.php" ?>