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

  // **********leftgraph*******************


  window.onload = function () {

    // ******************棒グラフ***************

    let context = document.getElementById('leftGraph').getContext('2d');

    new Chart(context, {
      type: 'bar',
      data: {
        labels: ['',2,'',4,'',6,'',8,'',10,'',12,'',14,'',16,'',18,'',20,'',22,'',24,'',26,'',28,'',30],
        // ↑日付の配列をぶち込む

        // x軸の中身を記述

        datasets: [{
          backgroundColor: "#017AC5",
          // ここにhoursが入る
          data: ['3','4','5','3','0','0','4','2','2','8','8','2','2','1','7','4','4','3','3','3','2','2','6','2','2','1','1','1','7','8'],
        }],
      },
      options: {
        scales: {
          y:{
            ticks:{
              callback: function(value,index,values){
                return value + 'h';
              },
              stepSize: 2,
            },
            grid :{
              display: false,
            },
          },
          x:{
            ticks: {
              display: true,
              drawTicks: false,
            }
          }
        },
        plugins:{
          legend:{
            display: false,
          }
        },
        responsive: true,
      }
    })

    // ************円グラフ*********************

    let contextTwo = document.getElementById('learningLanguageGraph').getContext('2d');

    new Chart(contextTwo, {
      type: 'doughnut',
      options:{
        plugins:{
          legend:{
            position: "bottom",
          },
          datalabels:{
            color:"white",
            formatter: function(value,context){
              return value.toString()+ '%';
            }
          }
        },
        responsive: true,
      },
      plugins: [ChartDataLabels],
      data:{
        labels:["HTML","CSS","JavaScript","PHP","Laravel","SQL","SHELL","その他"],
        render: "percentage",
        datasets:[{
          backgroundColor:["#0345EC","#0F71BD","#20BDDE","#3CCEFE","#B29EF3","#6D46EC","#4A17EF","#3105C0"],
          data:[30,20,10,5,5,10,10,10]
        }]
      },
    })


    // ***********円グラフ２**************

    let contextThree = document.getElementById('learningContentsGraph').getContext('2d');

    new Chart(contextThree, {
      type: 'doughnut',
      options:{
        plugins:{
          legend:{
            position: "bottom",
          },
          datalabels:{
            color:"white",
            formatter: function(value,context){
              return value.toString()+ '%';
            }
          }
        },
        responsive: true,
      },
      plugins: [ChartDataLabels],
      data:{
        labels:["N予備校","ドットインストール","課題"],
        datasets:[{
          backgroundColor:["#0345EC","#0F71BD","#20BDDE"],
          data:[40,20,40],
        }],
      }
    }) 
    
    

  }


}