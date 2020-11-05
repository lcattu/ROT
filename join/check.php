<?php 

session_start();
require('../function.php');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　確認ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');



  if(!isset($_SESSION['join'])){
    //  joinにセッションがissetされてない場合
    debug('$_SESSIONが空なのでindex.phpに戻ります');
    header('Location: index.php');
    //  上記の条件(SESSIONに情報方ない)の場合
    //  強制的にindex.phpに戻す処理
    //  例えばURLを直接入力し、check.phpにアクセスした場合
    //  $_SESSSIONに情報がない状態なので強制的に、index.phpにもどす処理
    exit();
  }

  if(isset($_POST['submit_btn'])){

    if(!empty($_SESSION['join'])){
      $username = $_SESSION['join']['s_name'];
      $email = $_SESSION['join']['s_email'];
      $password = $_SESSION['join']['l_password'];

      try{
        $dbh = dbConnect();

        $sql = 'INSERT INTO users (user_name,mail, password, created_at, updated_at) VALUES (:s_name, :s_email, :s_password, :login_time, :created_date)';

        //$dataに自分が定義したname属性をキー、$_POSTを代入している変数を要素とする配列を代入
        $data = array(
          ':s_name'=>$username, ':s_email'=>$email, ':s_password'=>password_hash($password,PASSWORD_DEFAULT),
        ':login_time' => date('Y-m-d H:i:s'), ':created_date' => date('Y-m-d H:i:s')
        );

        debug('dataの中身：'.print_r($data,true));


        //クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        debug('クエリ実行の中身：'.print_r($stmt,true));

          if(isset($stmt)){




            header("Location:thanks.php");
          }
        
        
        

      }catch(Exeption $e){
        print("DB接続エラー:".$e->getMessage());

      }



      

    }
  }

  
  /*
   $data =execute(array(
     $_SESSION['join']['name'],
     $_SESSION['join']['email'],
     sha1($_SESSION['join']['password']),
     sha1($_SESSION['join']['certify_password'])
    ));
   
   $stmt = queryPost($dbh, $sql, $data);
  */
  /*
    $statement = $db->prepare('INSERT INTO users SET user_name=?,mail=?, password=?, certify_password=?, created_at=NOW()');
    debug('$statementの中身：'.print_r($statement,ture));

    $statement->execute(array(
      $_SESSION['join']['s_name'],
      $_SESSION['join']['s_email'],
      sha1($_SESSION['join']['s_password']),
      sha1($_SESSION['join']['certify_password'])
    ));
  */

  



?>



<?php require "../head.php"; ?>
<body>
  <!-- ヘッダー -->
  <?php require "join_header.php" ?>

  <h1>Replication of Twitter</h1>


  <div class=" c-welcomeWrapper" style="display:block;">
    <div class="c-modalWrapper" >
      <div class="c-modal__body p-modal__body active">
        <h3 class="p-modal__body--title">#3 確認画面</h3>
        <form action="" method="post" >

          <input type="hidden" name="action" value="submit" />
          <dl class="">
            <dt>ニックネーム</dt>
            <dd>
              <?php echo(htmlspecialchars($_SESSION['join']['s_name'],ENT_QUOTES)); ?>
            </dd>

            <dt>メールアドレス</dt>
            <dd>
              <?php echo(htmlspecialchars($_SESSION['join']['s_email'],ENT_QUOTES)); ?>

            </dd>

            <dt>パスワード</dt>
            <dd>
              【表示されません】
            </dd>
          </dl>

          <div>
            <a href="index.php?action==rewrite">&laquo; &nbsp; 書き直す</a>|<input type="submit" name="submit_btn" value="登録する">
            
          </div>
        </form>

          
      </div>  
    </div>
          
  </div>
</body>
<?php require"../footer.php" ?>