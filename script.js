$(function(){

  $('.index-btn').click(function(){
    $('.active').removeClass('active');

    var clickedIndex = $('.index-btn').index($(this));

    $('.c-modal__body').eq(clickedIndex).addClass('active');
  });

  //

  

  /*
  hideメソッドを用いて、
  ・slideIndexが0のとき、
  .prev-btn
  要素を隠してください。
  ・slideIndexが2のとき、
  .next-btn
  要素を隠す。
  
  */

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


    $('.regi-btn').hide();

    $('.alter-btn').hide();
    

  }else if(slideIndex == 1){

    $('.regi-btn').hide();

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

   //  チェックが入っていたら有効化
   /** 
   if('#check').not(':checked')){
    //  
    $('.next-btn').removeClass('next-btn');
    
  } else {
    //  有効化
    $('.next-btn').addClass('next-btn');
  }
  */




});
