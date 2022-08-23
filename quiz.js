'use strict';

{
  // 解答を入力する

  const CORRECT_ANSWERS = [
    {
      index: 1,
      value: '約79万人'
    },
    {
      index:2,
      value: 'X-TECH'
    },
    {
      index: 0,
      value: 'Internet of Things'
    },
    {
      index: 0,
      value: 'Society 5.0'
    },
    {
      index: 0,
      value: 'Web3.0'
    },
    {
      index: 1,
      value: '約5倍'
    }
  ];

  const allQuiz = document.querySelectorAll('.js-quiz');

  const setDisabled = answers => {
    answers.forEach(answer => {
      answer.disabled = true;
    })
  }

  const setTitle = (target, isCorrect) =>{
    target.innerText = isCorrect ? '正解！' : '不正解...';
  }
  
  const setClassName = (target, isCorrect) => {

    target.classList.add(isCorrect ? 'is-correct' : 'is-incorrect');
    // 色をCSSで追加する。
    
  }


  allQuiz.forEach(quiz => {

    const answers = quiz.querySelectorAll('.js-answer');
    // 各ボタンの選択肢一つ一つ

    const arrows = quiz.querySelectorAll('.arrow');

    const selectedQuiz = Number(quiz.getAttribute('data-quiz'));
    // 👆復習 問題番号

    const answerBox = quiz.querySelector('.js-answerBox');
    // 答えのセクション（一塊）

    const answerTitle = quiz.querySelector('.js-answerTitle');
    // 正解or不正解

    const answerText = quiz.querySelector('.js-answerText');
    // 正しい答えの表示

    answers.forEach(answer => {
      // ↓復習
      answer.addEventListener('click',() =>{
        
        arrows.forEach(arrow =>{
          arrow.classList.add('delete');
        })

        answer.classList.add('is-selected');
        const selectedAnswer = Number(answer.getAttribute('data-answer'));
        // それぞれの選択肢番号]

        setDisabled(answers);

        const isCorrect = CORRECT_ANSWERS[selectedQuiz].index === selectedAnswer;

        answerText.innerText = CORRECT_ANSWERS[selectedQuiz].value;

        setTitle(answerTitle, isCorrect);
        setClassName(answerBox,isCorrect);
      })
    })
  })
}