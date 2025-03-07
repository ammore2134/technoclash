document.addEventListener("DOMContentLoaded", function () {
    // Fetch questions from PHP session
    let questions = <?php echo json_encode($_SESSION['questions'] ?? [], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE); ?>;
    let currentQuestionIndex = 0;
    let score = 0;

    // Set timer (Convert minutes to seconds)
    let timerDuration = <?php echo !empty($quiz['duration']) ? (int)$quiz['duration'] : 10; ?> * 60;
    let timerElement = document.getElementById("timer");

    let quizContainer = document.getElementById("quiz-container");
    let questionText = document.getElementById("question-text");
    let optionsContainer = document.getElementById("options-container");
    let nextButton = document.getElementById("next-btn");
    let scoreDisplay = document.getElementById("score");

    function startQuiz() {
        if (questions.length === 0) {
            alert("No questions available for this quiz.");
            return;
        }
        displayQuestion();
        startTimer();
    }

    function displayQuestion() {
        if (currentQuestionIndex >= questions.length) {
            endQuiz();
            return;
        }

        let currentQuestion = questions[currentQuestionIndex];
        questionText.innerHTML = `Q${currentQuestionIndex + 1}: ${currentQuestion.question}`;
        optionsContainer.innerHTML = "";

        let options = [
            currentQuestion.option1,
            currentQuestion.option2,
            currentQuestion.option3,
            currentQuestion.option4
        ];

        options.forEach((option, index) => {
            let button = document.createElement("button");
            button.classList.add("option-btn");
            button.innerHTML = option;
            button.onclick = function () {
                checkAnswer(index + 1, currentQuestion.correct_option);
            };
            optionsContainer.appendChild(button);
        });
    }

    function checkAnswer(selectedOption, correctOption) {
        let buttons = document.querySelectorAll(".option-btn");
        buttons.forEach(btn => btn.disabled = true);

        if (selectedOption == correctOption) {
            score += 10; // Increase XP if answer is correct
        }

        scoreDisplay.innerHTML = `Score: ${score}`;
    }

    nextButton.addEventListener("click", function () {
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            displayQuestion();
        } else {
            endQuiz();
        }
    });

    function startTimer() {
        let interval = setInterval(function () {
            if (timerDuration <= 0) {
                clearInterval(interval);
                endQuiz();
            } else {
                let minutes = Math.floor(timerDuration / 60);
                let seconds = timerDuration % 60;
                timerElement.innerHTML = `Time Left: ${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
                timerDuration--;
            }
        }, 1000);
    }

    function endQuiz() {
        quizContainer.innerHTML = `<h2>Quiz Over!</h2>
                                   <p>Your Final Score: ${score}</p>
                                   <button onclick="window.location.href='dashboard.php'">Go to Dashboard</button>`;
        alert("Quiz Over!");
    }

    startQuiz();
});
