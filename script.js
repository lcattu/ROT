$(function(){
  $('.loginBtn').click(function(){
    console.log('push_loginBtn');


    $('.p-loginWrapper').fadeIn();
    
    $('.c-modal__regiBody').addClass('active');
    

  });


  $('.startBtn').click(function(){
    console.log('push1');
    $('.c-welcomeWrapper').fadeIn();
    $('.c-modal__body').eq(0).addClass('active');
    $('.prev-btn').hide();
    $('.alter-btn').hide();
    $('.next-btn').show();

  });

  $('.closeBtn').click(function(){
    console.log('push! closeBtn');
    $('.p-loginWrapper').fadeOut();
    

    $('.c-welcomeWrapper').fadeOut();

    $('.c-modal__regiBody').removeClass('active');

    $('.c-modal__body').removeClass('active');
  })

  //  
  $('.change-btn').click(function() {
    var $displaySlide = $('.active');
    //  ① 変数$displaySlideに'.active'クラスを代入

    $displaySlide.removeClass('active');
    /*
      ②'.active'クラスをremoveClassﾒｿｯﾄﾞで取り除く
      ∟  HTML&CSSの確認を怠らない (´;ω;｀)
        - 親クラスのモーダルにも'.active'クラスをついてて、モーダルごと消えたΣ(ﾟдﾟlll)ｶﾞｰﾝ
    */

    //  ③条件分岐
    if ($(this).hasClass('next-btn')) {
        //  1) このClickが行われた際にhasClassﾒｿｯﾄﾞで'next-btn'ｸﾗｽがあるか否かで条件分岐

        $displaySlide.next().addClass('active');
        //  2)  ( ･´ｰ･｀)ここ大事‼
          /*
            ♦prev()とnext()  ﾌﾟﾚﾌﾞﾒｿｯﾄﾞとﾈｸｽﾄﾒｿｯﾄﾞ
            - prevメソッドは、jQueryオブジェクトの兄弟要素（同じ階層の要素）の中から1つ前の要素を、nextメソッドは1つ後ろの要素を取得することができます。
          */
        
    } else {
        $displaySlide.prev().addClass('active');
    }




    var slideIndex = $('.c-modal__body').index($('.active'));
    //  ④ 変数slideIndexに 「.c-modal__body」の中の「.active」要素のインデックス番号を代入


    $('.change-btn').show();

    //  ボタン表示・非表示に関するプログラム
    //  ⑤ ④の変数の宣言で得たインデックス番号による条件分岐
    if(slideIndex == 0){

      $('.prev-btn').hide();


      $('.alter-btn').hide();
    

    }else if(slideIndex == 1){


      $('.next-btn').hide();
      $('.alter-btn').show();

      /** -----------------------
       * チェックボックスにﾁｪｯｸがあるか否かの確認 
      ------------------------------------------**/

      $('#check').click(function(){
        if($('#check').prop('checked')){
          $('.next-btn').show();
          $('.alter-btn').hide();

          console.log('OK');
        }else{
          $('.next-btn').hide();
          $('.alter-btn').show();
          console.log('NO');
        }
      });
       
    
    }else if(slideIndex == 2){

      $('.next-btn').hide();

      $('.regi-btn').show();

      
    }
  });


  /**----------------------------------------
   * check.phpの”書き直し”を押されたときの挙動
  --------------------------------------------*/

  var URL = 'http://localhost:8888/rot/join/index.php?action=rewrite';


  $(window).on('load',function(){
    if(location.href == "http://localhost:8888/rot/join/index.php?action=rewrite"){
      $('.c-modal__body').removeClass('active');
      console.log('');
      $('.c-modal__body').eq(2).addClass('active');
      /**
     *ボタン表示の修正 
     */
      console.log('join/check.php『戻るボタン』がクリックされました');
      $('.prev-btn').show();
      $('.alter-btn').hide();
      $('.next-btn').hide();

    }

        
  })

  /**----------------------------------------
   * join/index.php
   * ”入力内容を確認する”ボタンを押されたときの
   * c-modal__bodyのインデックスへの挙動
  --------------------------------------------*/

  if($('p').hasClass('error')){

    console.log('find error#1');


    $('.error').css({"color":"red"});
    $('.c-modal__body').removeClass('active');
    $('.c-modal__body').eq(2).addClass('active');


    /**
     *ボタン表示の修正 
     */
    
    if($('.c-modal__body').eq(2).addClass('active')){
      console.log('find error#2');

      $('.prev-btn').show();
      $('.alter-btn').hide();
      $('.next-btn').hide();
    }
    
  }

});
