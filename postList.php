<?php 

debug('「　投稿一覧　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


/*-------------------------------
	画面処理
-------------------------------*/


?>

<main>
  <section class="l-siteWrap">
    <article class ="c-post">
      <div class="c-contents">

              

        <div class="c-iconWrapper">
          <a href="#">
            <img src="image/icon_demo.jpg" class="c-iconWrapper__usericon">
          </a>
        </div>
        <div class="postWrapper">
          <div class="postContents">
            <div class="postContents__head">
              <a href="" class="username">DEMO_USERNAME</a>
            </div>
            <time>time XXXXXXXXXXXX</time>
            <div class="postContents__body">
              <div class="postContents__body__message">

                <p>DEMO DEMO DEMO</p>
              </div>
              <div class="postCOntents__body__image"></div>
            </div>
            <div class="postContents__foot">
              <div class="commentBtn">
                <a href="">
                  <i class="far fa-comment-alt fa-lg px-16"></i>
                </a>
              </div>

              <div class="goodBtn">
                <i class="fa-heart fa-lg px-16 far">

                </i>
              </div>
            </div>
          
          </div>
        </div>

      </div>

    </article>
    <?php 
      echo'ユーザーIDについて<br>';
      var_dump($_SESSION['user_id']);
    ?>
  </section>
</main>