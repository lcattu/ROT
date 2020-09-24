$(function(){


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


  /**
   * check.phpの”書き直し”を押されたときの挙動
  */

  var URL = 'http://localhost:8888/rot/join/index.php?action=rewrite';

  /*
  if(location.href=URL){
    //$('.c-modal__body').removeClass('active');
    
    //var modal__bodyIndex = $('.c-welcomeWrapper').index('.c-modal__body');

    //alert();

    //$(modal__bodyIndex == 2).addClass('active');


    
  }
  */

  $(window).on('load',function(){
    if(location.href == "http://localhost:8888/rot/join/index.php?action=rewrite"){
      $('.c-modal__body').removeClass('active');

      $('.c-modal__body').eq(2).addClass('active');
    }
    
    
  })

  if($('p').hasClass('error')){
    console.log('find error');
    $('.error').css({"color":"red"});
    $('.c-modal__body').removeClass('active');


    $('.c-modal__body').eq(2).addClass('active');
  }

  /*
  $(window).on("unload",function(){
    console.log('アンロード');
    if(location.href == "http://localhost:8888/rot/join/index.php"){
      $('.c-modal__body').removeClass('active');

      $('.c-modal__body').eq(2).addClass('active');
    }
  });
  */
  //var $regiCheck = console.log(php.regi_check);
  
  /*
  $(document).on('click', '.input-btn', function(){
    $('form').submit(function(){
      var $regiCheck = console.log(php.regi_check);
      if($regiCheck = 1){
        console.log('-------------------------');
        
        
        console.log('実行中');
        alert('入力しましょう');
        return false;

      }else if($regiCheck =''){
        
        $('form').submit();

        
      }

    } );

  });
  */


     /* 
      if(regiCheck = 1 ){
        
        console.log('鎮火--------------------------------------------------------------------------------');
        ;
        $('.c-modal__body').removeClass('active');
    
        $('.c-modal__body').eq(2).addClass('active');
      }
      */
  /*
  if(regiCheck = 1 ){
    $('.c-modal__body').removeClass('active');

    $('.c-modal__body').eq(2).addClass('active');
  }
  */

  /*
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
  */  
});
