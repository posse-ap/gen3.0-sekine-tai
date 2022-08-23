'use strict';

{

  const ALL_QUIZ = [
    {
      id: 1,
      question: '日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？',
      answers: ['約28万人', '約79万人', '約183万人'],
      correctNumber: 1,
      note: '経済産業省 2019年3月 － IT 人材需給に関する調査'
    },
    {
      id: 2,
      question: '既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？',
      answers: ['INTECH', 'BIZZTECH', 'X-TECH'],
      correctNumber: 2,
    },
    {
      id: 3,
      question: 'IoTとは何の略でしょう？',
      answers: ['Internet of Things', 'Integrate into Technology', 'Information on Tool'],
      correctNumber: 0,
    },
    {
      id: 4,
      question: 'イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？',
      answers: ['Society 5.0', 'CyPhy', 'SDGs'],
      correctNumber: 0,
      note: 'Society5.0 - 科学技術政策 - 内閣府'
    },
    {
      id: 5,
      question: 'イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？',
      answers: ['Web3.0', 'NFT', 'メタバース'],
      correctNumber: 0,
    },
    {
      id: 6,
      question: '先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？',
      answers: ['約2倍', '約5倍', '約11倍'],
      correctNumber: 1,
      note: 'Accenture Technology Vision 2021'
    }
  ];

  const quizContainer = document.getElementById('js-quizContainer');

  const createQuizHtml = (quizItem, questionNumber) => {

    const answerHtml = quizItem.answers.map((answer, answerIndex) => `<button class="js-answer choice" data-answer="${answerIndex}">
    ${answer}
    <img src="./img/icon/icon-arrow.svg" alt="arrow" class="arrow">            
</button>`).join('');

    const noteHtml = quizItem.note ? `
    <div class="itSource">
              <div class="itSourceContainer">
                <p>
                  <img src="./img/icon/icon-note.svg" alt="note">
                </p>
                <p>
                  ${quizItem.note}
                </p>
              </div>
            </div>
            ` : '';


            return ` <div class="questionIt js-quiz" data-quiz="${questionNumber}">
            <div class="questionContainer"> 
              <div class="questionParagraph"> 
                <h2 class="questionNumber">Q${questionNumber + 1}</h2>
                <p class="questionParagraph">${quizItem.question}</p>
                <div class="itImgContainer">
                  <img src="./img/quiz/img-quiz0${questionNumber + 1}.png" alt="questionIt" class="ItImg">
                </div>
              </div>
              <div class="questionAnswer">
                <h2 class="answerNumber">A</h2>
              <ul class="choices">
                ${answerHtml}
              </ul>

              <div class="js-answerBox">
    <div class="AnswerResultContainer">
      <h2 class="Result js-answerTitle">
        <!-- seikai -->
      </h2>
      <div class="ResultDetailContainer">
        <p class="A">
          A
        </p>
        <p class="ResultDetail js-answerText">
          <!-- kotae -->
        </p>
      </div>
    </div>
  </div>

  ${noteHtml}

</div>
</div>
</div>
`

}

const shuffle = arrays => {
  const array = arrays.slice();
  for (let i = array.length - 1; i>= 0;i--){
    const randomIndex = Math.floor(Math.random()*(i + 1));
    [array[i],array[randomIndex]]=[array[randomIndex],array[i]];
  }
  return array
}

const quizArray = shuffle(ALL_QUIZ)

quizContainer.innerHTML = quizArray.map((quizItem, index) => {
  return createQuizHtml(quizItem,index)
}).join('')

const allQuiz = document.querySelectorAll('.js-quiz');

const setDisabled = answers => {
  answers.forEach(answer => {
    answer.disabled = true;
  })
}

const setTitle = (target, isCorrect) => {
  target.innerText = isCorrect ? '正解！':'不正解...';
}

const setClassName = (target,isCorrect) => {
  target.classList.add(isCorrect ? 'is-correct' : 'is-incorrect');
}

allQuiz.forEach(quiz => {
  const answers = quiz.querySelectorAll('.js-answer');
  const arrows = quiz.querySelectorAll('.arrow');
  const selectedQuiz = Number(quiz.getAttribute('data-quiz'));
  const answerBox = quiz.querySelector('.js-answerBox');
  const answerTitle = quiz.querySelector('.js-answerTitle');
  const answerText = quiz.querySelector('.js-answerText');

  answers.forEach(answer => {
    answer.addEventListener('click', () => {
      answer.classList.add('is-selected');
      const selectedAnswerNumber = Number(answer.getAttribute('data-answer'));

      arrows.forEach(arrow => {
        arrow.classList.add('delete');
      })

      // 全てのボタンを非活性化
      setDisabled(answers);

      // 正解ならtrue, 不正解ならfalseをcheckCorrectに格納
      const correctNumber = quizArray[selectedQuiz].correctNumber
      const isCorrect = correctNumber === selectedAnswerNumber;

      // 回答欄にテキストやclass名を付与
      answerText.innerText = quizArray[selectedQuiz].answers[correctNumber];
      setTitle(answerTitle, isCorrect);
      setClassName(answerBox, isCorrect);
    })
  })
})






}