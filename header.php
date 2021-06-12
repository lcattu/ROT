
<header class="l-header01">
  <div class="l-headerWrapper">
    <div class="l-headerWrapper__left">
      <img src="images/ROT_logo.jpg" alt="" class="d-none d-lg-block  p-logo__image-PC">


      <img src="images/logo_test.jpg" alt="" class="d-lg-none p-logo__image">
    </div>

  


      <!-- セッションに user_id がない場合 -->
      <div class="l-headerWrapper__right">

      <?php if(empty($_SESSION['user_id'])){ ?>

        <div class="p-login">
          <a href="join_index.php?action==login">ログイン</a>
        </div>
      <?php }else{ ?>
      <!-- セッションに user_id がある場合 -->
      <a href="user_proFile.php?u_id=<?php echo $_SESSION['user_id'];?>"><i class="far fa-address-card"></i></a>
      </div>

    <?php } ?>

  </div>
</header>
