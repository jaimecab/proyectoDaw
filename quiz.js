const questions = [
    {
        question: "¿Cuál es la capital de Francia?",
        answers: ["Madrid", "París", "Berlín", "Roma"],
        correct: 1
    },
    {
        question: "¿Cuántos continentes tiene el mundo?",
        answers: ["5", "6", "7", "8"],
        correct: 2
    },
    {
        question: "¿Qué año llegó el hombre a la luna?",
        answers: ["1965", "1969", "1971", "1973"],
        correct: 1
    }
];

let currentQuestion = 0;
let score = 0;

function loadQuestion() {
    const questionEl = document.getElementById('question');
    const answersEl = document.getElementById('answers');
    const nextButton = document.getElementById('nextButton');
    
    questionEl.innerText = questions[currentQuestion].question;
    answersEl.innerHTML = '';

    questions[currentQuestion].answers.forEach((answer, index) => {
        const button = document.createElement('button');
        button.innerText = answer;
        button.onclick = () => selectAnswer(index);
        answersEl.appendChild(button);
    });

    nextButton.style.display = 'none';
}

function selectAnswer(selectedIndex) {
    const correctIndex = questions[currentQuestion].correct;
    const answersEl = document.getElementById('answers');

    Array.from(answersEl.children).forEach((button, index) => {
        if (index === correctIndex) {
            button.style.backgroundColor = 'green';
        } else if (index === selectedIndex) {
            button.style.backgroundColor = 'red';
        }
        button.disabled = true;
    });

    if (selectedIndex === correctIndex) {
        score++;
    }

    const nextButton = document.getElementById('nextButton');
    nextButton.style.display = 'block';
}

document.getElementById('nextButton').addEventListener('click', function() {
    currentQuestion++;
    if (currentQuestion < questions.length) {
        loadQuestion();
    } else {
        showScore();
    }
});

function showScore() {
    document.getElementById('quiz').innerHTML = `
        <h3>Has terminado el quiz</h3>
        <p>Tu puntaje es: ${score} de ${questions.length}</p>
    `;
}

loadQuestion();
