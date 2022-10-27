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
        labels: ['',2,'',4,'',6,'',8,'',10,'',12,'',14,'',16,'',18,'',20,'',22,'',24,'',26,'',28,'',30,'',],

        // x軸の中身を記述

        datasets: [{
          data: [3,4,5,3,0,0,4,2,2,8,8,2,2,1,7,4,4,3,3,3,2,2,6,2,2,1,1,1,1,7,8],
        }],
      },
      options: {
        scales: {
          xAxes: [
            {
              display: false,
              scaleLabel:{
                display: true,
              },
              ticks:{
                display: false,
              }
            }
          ],
          yAxes: [
            {
              display: false,
              ticks:{
                display: false,
              }
            }
          ]
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
      data:{
        labels:["HTML","CSS","JavaScript","PHP","Laravel","SQL","SHELL","その他"],
        datasets:[{
          backgroundColor:[],
          data:[30,20,10,5,5,20,20,10]
        }]
      }
    })


    // ***********円グラフ２**************

    let contextThree = document.getElementById('learningContentsGraph').getContext('2d');

    new Chart(contextThree, {
      type: 'doughnut',
      data:{
        labels:["N予備校","ドットインストール","課題"],
        datasets:[{
          backgroundColor:[],
          data:[40,20,40],
        }]
      }
    })





    
  }



}