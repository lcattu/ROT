<?php require "../head.php"; ?>
<body>
  <!-- ヘッダー -->
  <?php require "join_header.php" ?>

  <h1>Replication of Twitter</h1>


  <div class="p-welcomeWrapper">

        <!--#0 p-greetingModal -->
        <div class="c-modal p-greetingModal">
        
        <div class="c-welcomeWrapper">
          <!-- #0 -->
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
          <div class="c-modal__body">
            <h3 class="c-modal__title">#2 登録画面</h3>
            <p>登録ボタンを追加していく</p> 
            <form action="" method="" enctype="">
              <dl>
                <dt>ニックネーム</dt>
                <dd>
                  <input type="text">
                </dd>

                <dt>メールアドレス</dt>
                <dd>
                  <input type="text">
                </dd>

                <dt>パスワード</dt>
                <dd>
                  <input type="password">
                </dd>

                <dt>パスワード(確認)</dt>
                <dd>
                </dd>

                <dt></dt>
                <dd>
                </dd>

              </dl>
              <div>
                <input type="submit">
              </div>
            </form>

            </div>

        </div>
        

        <!-- change-btn-wrapper -->
        <div class="c-modal__footer">
          <div class="change-btn prev-btn">←戻る</div>

          
          <div class="change-btn next-btn" >登録へ→</div>

          <div class="alter-btn">登録へ→</div>



          <div class="change-btn regi-btn">登録</div>
        </div>
    </div>
  </div>


<script src="../script.js"></script>
</body>

<?php require"../footer.php" ?>