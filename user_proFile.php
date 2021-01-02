<?php

require('function.php');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ユーザーページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

require('auth.php');

/*-------------------------------
	画面処理
-------------------------------*/
$u_id = $_GET['u_id'];
$dbPostData = '';
$dbPostGood = '';
debug(print_r($u_id,true));

//get送信があり かつ getUser関数で SQLのusersテーブルユーザー情報を取得が あった場合
if(!empty($_GET['u_id']) && !empty(getUser($u_id))){
  $dbPostUserInfo = getUser($u_id);
  //$dbPostData = getUserPostList($u_id);
  //$dbPostGoodNum = count(getUserGoodPostList($u_id));
  debug('$u_idの中身：'.print_r($u_id,true));
  
  
}else{
  debug('$_GETが失敗です');
  header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php require"head.php" ?>

<body>
  <?php require "header.php";?>

  <main>


<!--  -->
  <section class = "l-siteWrap">
    <div class="p_profileWrapper ">

      <!-- ユーザー自身の場合のみ編集ボタンを -->

      <div class="p_profileWrapper__left">
        <!-- ユーザーの写真 -->
        <div class="p_profile__img">
          <img src="./image/selficon.jpg" alt="">

        </div>
      </div>
<!--  -->

      <div class="p_profileWrapper__right">
        <!-- ユーザーの名前 -->
        <div class="p_profile__name">
          <p>名前：<?php echo $dbPostUserInfo['user_name']; ?>
          </p>



          <a href="user_proFile.php?u_id=<?php echo $_SESSION['user_id'] ?>&menu=proEdit">編集<i class="fas fa-edit"></i></a>
        </div>

<!--  -->
        <!-- ユーザーの自己紹介 -->
        <div class="p_profile__intro">
          <span class="p_profile__intro__title">
            自己紹介
          </span>
          <p>プログラミング学習する人✏️/  学習開始日2019年10月12日～🗓️/  会社の事務経理担当💻/  地元北海道の田舎をプログラミングで豊かに/#今日の積み上げ　を中心につぶやきます/#駆け出しエンジニアと繋がりたい / #codelife 8期/ #つみあげハウス</p>
        </div>
      </div>
      
    </div>
<!--  -->

    <!-- 過去の投稿内容 -->
    <?php 
    
    if($_GET['menu'] === 'proEdit'){
      debug('発火：プロフィール編集');
      //プロフィール編集
      require"user_proEdit.php";
    }

    ?>


  </section>

	</main>


</body>

</html>