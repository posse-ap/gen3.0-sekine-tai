'use strict';
{
  


  $(function(){

    $('.modalOpen').click(function(){
      $('#overLay, .modalWindow').fadeIn();
    });

    $('.modalClose').click(function(){
      $('#overLay, .modalWindow').fadeOut();
    })

    $('.modalPost').click(function(){
      $('.modalWindow').fadeOut();
      $('.modalLoading').fadeIn();
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

        // x軸の中身を記述

        datasets: [{
          backgroundColor: "#017AC5",
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
        },
      },
      data:{
        labels:["HTML","CSS","JavaScript","PHP","Laravel","SQL","SHELL","その他"],
        render: "percentage",
        datasets:[{
          backgroundColor:["#0345EC","#0F71BD","#20BDDE","#3CCEFE","#B29EF3","#6D46EC","#4A17EF","#3105C0"],
          data:[30,20,10,5,5,20,20,10]
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
          }
        }
      },
      data:{
        labels:["N予備校","ドットインストール","課題"],
        datasets:[{
          backgroundColor:["#0345EC","#0F71BD","#20BDDE"],
          data:[40,20,40],
        }]
      }
    }) 
    
    

  }

  


}