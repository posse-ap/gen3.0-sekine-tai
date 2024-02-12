'use strict';
{


  function openTwitter(text,url,hash,account) {
    var turl = "https://twitter.com/intent/tweet?text="+text+"&url="+url+"&hashtags="+hash+"&via="+account;
    window.open(turl,'_blank');
  }
  


  $(function(){

    $('.modalOpen').click(function(){
      $('#overLay, .modalWindow').fadeIn();
    });

    $('.modalInput').click(function(){
      $('#overLay, .modalCalender').fadeIn();
      // $('.modalWindow').fadeOut();
    })

    $('.modalClose').click(function(){
      $('#overLay, .modalWindow').fadeOut();
    })
    
    $('.modalBack').click(function(){
      $('#overLay, .modalWindow').fadeIn();
      $('.modalCalender').fadeOut();
    })

    $('.select').click(function(){
      $('.modalCalender').fadeOut();
    })

    $('.modalPost').click(function(){

      $('.modalWindow').fadeOut();
      $('.modalLoading').fadeIn();

      const share = document.getElementById('shareTwitter').checked;

      console.log(share);

      if(share == true){

      const postText = document.getElementById('postText');
      

      const text = postText.value;

      openTwitter(text,"","","");

      }

      setTimeout(function(){
        $('.modalLoading').fadeOut();
        $('.modalPosted').fadeIn();
      },3000);

    })

    $('.modalPostedNav').click(function(){
      $('.modalPosted').fadeOut();
    })

  });


}