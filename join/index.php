<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ROT会員登録</title>

  <link rel="stylesheet" href="../css/stylesheet.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <header class="l-header01">
    <div class="l-headerWrapper">
      <div class="l-headerWrapper-left">
        <img src="../image/logo_test.jpg" alt="" class="d-none d-lg-block  p-logo__image-PC">


        <img src="../image/logo_test.jpg" alt="" class="d-lg-none p-logo__image">
      </div>

    
      <div class="l-headerWrapper-right">
        <div class="c-login">
          <a>ログイン</a>
        </div>
      </div>
    </div>
  </header>



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
</html>