$(function(){
  $('.p-loginBtn').click(function(){
    console.log('push_loginBtn');


    $('.c-loginWrapper').fadeIn();
    
    $('.c-modal__regiBody').addClass('active');
    

  });


  $('.p-startBtn').click(function(){
    console.log('push1');
    $('.c-welcomeWrapper').fadeIn();
    $('.c-modal__body').eq(0).addClass('active');
    $('.p-prev-btn').hide();
    $('.p-alter-btn').hide();
    $('.p-next-btn').show();

  });

  $('.p-closeBtn').click(function(){
    console.log('push! p-closeBtn');
    $('.c-loginWrapper').fadeOut();
    

    $('.c-welcomeWrapper').fadeOut();

    $('.c-modal__regiBody').removeClass('active');

    $('.c-modal__body').removeClass('active');
  })

  //  
  $('.p-change-btn').click(function() {
    var $displaySlide = $('.active');
    //  ① 変数$displaySlideに'.active'クラスを代入

    $displaySlide.removeClass('active');
    /*
      ②'.active'クラスをremoveClassﾒｿｯﾄﾞで取り除く
      ∟  HTML&CSSの確認を怠らない (´;ω;｀)
        - 親クラスのモーダルにも'.active'クラスをついてて、モーダルごと消えたΣ(ﾟдﾟlll)ｶﾞｰﾝ
    */

    //  ③条件分岐
    if ($(this).hasClass('p-next-btn')) {
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


    $('.p-change-btn').show();

    //  ボタン表示・非表示に関するプログラム
    //  ⑤ ④の変数の宣言で得たインデックス番号による条件分岐
    if(slideIndex == 0){

      $('.p-prev-btn').hide();


      $('.p-alter-btn').hide();
    

    }else if(slideIndex == 1){


      $('.p-next-btn').hide();
      $('.p-alter-btn').show();

      /** -----------------------
       * チェックボックスにﾁｪｯｸがあるか否かの確認 
      ------------------------------------------**/

      $('#check').click(function(){
        if($('#check').prop('checked')){
          $('.p-next-btn').show();
          $('.p-alter-btn').hide();

          console.log('OK');
        }else{
          $('.p-next-btn').hide();
          $('.p-alter-btn').show();
          console.log('NO');
        }
      });
       
    
    }else if(slideIndex == 2){

      $('.p-next-btn').hide();

      $('.regi-btn').show();

      
    }
  });


  /**----------------------------------------
   * check.phpの”書き直し”を押されたときの挙動
  --------------------------------------------*/

  

  $(window).on('load',function(){
    if(location.href == "http://localhost:8888/rot/join/index.php?action==rewrite"){
      $('.c-modal__body').removeClass('active');
      console.log('==rewriteなのでアクティブクラス外しました');
      $('.c-welcomeWrapper').fadeIn(0);
      console.log('c-welcomeWrapperをアクティブにしました');
      
      $('.c-modal__body').eq(2).addClass('active');
      
      

      /**
     *ボタン表示の修正 
     */
      console.log('join/check.php『戻るボタン』がクリックされました');
      $('.p-prev-btn').show();
      $('.p-alter-btn').hide();
      $('.p-next-btn').hide();

    }

        
  })

  /**----------------------------------------
   * join/index.php
   * ”入力内容を確認する”ボタンを押されたときの
   * c-modal__bodyのインデックスへの挙動
  --------------------------------------------*/
  if($('p').hasClass('login__error')){

    console.log('ログインのエラーがあります');


    $('.login').css({"color":"red"});
    $('.c-modal__body').eq(0).removeClass('active');
    $('.c-welcomeWrapper').removeClass('active');

    console.log('アクティブを取り除きました');

    $('.c-loginWrapper').fadeIn(0);
    $('.c-modal__regiBody').fadeIn(0);
    console.log('c-loginWrapper,c-modal__regiBodyをアクティブにしました');
    /**
     * c-welcomeWrapperでdisplay:none;を設定し、addClassメソッドを使用しactiveクラスを付け
     * 足そうと考えていた
     * しかし、activeクラスはつくものの、display:none;が消えず、activeにならなかったので
     * fadeInメソッドでaddClassの代用をすることとした
     */

    $('.c-loginWrapper').addClass('active');
    $('.c-modal__regBody').addClass('active');
    console.log('c-modal__bodyをアクティブにしました');

  /**
   *ボタン表示の修正 
    */
  
  
  }


  if($('p').hasClass('signup__error')){

    console.log('登録時のエラーがあります');


    $('.error').css({"color":"red"});
    $('.c-modal__body').eq(0).removeClass('active');
    console.log('アクティブを取り除きました');

    $('.c-welcomeWrapper').fadeIn(0);
    console.log('c-welcomeWrapperをアクティブにしました');
    /**
     * c-welcomeWrapperでdisplay:none;を設定し、addClassメソッドを使用しactiveクラスを付け
     * 足そうと考えていた
     * しかし、activeクラスはつくものの、display:none;が消えず、activeにならなかったので
     * fadeInメソッドでaddClassの代用をすることとした
     */

    $('.c-modal__body').eq(2).addClass('active');
    console.log('c-modal__bodyをアクティブにしました');

    /**
     *ボタン表示の修正 
    */
    
    if($('.c-modal__body').eq(2).addClass('active')){
    console.log('find signup__error#2');

    $('.p-prev-btn').show();
    $('.p-alter-btn').hide();
    $('.p-next-btn').hide();
    }
  
  }

 

});
