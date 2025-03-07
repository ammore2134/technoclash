let currentQuestion = 0;
let score = 0;
let correctCount = 0;
let incorrectCount = 0;
let xpPoints = 0;
let timer = 900; // 15 minutes

// Load question
function loadQuestion(index) {
    if (index >= questions.length) {
        endQuiz();
        return;
    }
    
    let questionData = questions[index];
    document.getElementById("question-text").innerText = questionData.question;
    
    let optionsContainer = document.getElementById("options-container");
    optionsContainer.innerHTML = "";
    
    let options = [questionData.option1, questionData.option2, questionData.option3, questionData.option4];
    options.forEach((opt, i) => {
        let btn = document.createElement("button");
        btn.innerText = opt;
        btn.onclick = () => checkAnswer(opt, questionData.correct_answer);
        optionsContainer.appendChild(btn);
    });

    document.getElementById("next-btn").style.display = "block";
    document.getElementById("prev-btn").style.display = index > 0 ? "block" : "none";
    document.getElementById("finish-btn").style.display = index === questions.length - 1 ? "block" : "none";
}

// Check answer
function checkAnswer(selected, correct) {
    if (selected === correct) {
        score += 10;
        correctCount++;
        xpPoints += 5;
    } else {
        incorrectCount++;
    }
    
    document.getElementById("correct-count").innerText = correctCount;
    document.getElementById("incorrect-count").innerText = incorrectCount;
    document.getElementById("xp-points").innerText = xpPoints.toFixed(2);
}

// Timer function
function startTimer() {
    let timeLeft = document.getElementById("time-left");
    let interval = setInterval(() => {
        if (timer <= 0) {
            clearInterval(interval);
            endQuiz();
        } else {
            let minutes = Math.floor(timer / 60);
            let seconds = timer % 60;
            timeLeft.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            timer--;
        }
    }, 1000);
}

// End Quiz
function endQuiz() {
    document.getElementById("question-text").innerText = "Quiz Over!";
    document.getElementById("options-container").innerHTML = `<h3>Your Score: ${score}</h3>`;
    
    document.getElementById("next-btn").style.display = "none";
    document.getElementById("prev-btn").style.display = "none";
    document.getElementById("finish-btn").style.display = "none";
    
    let redirectBtn = document.createElement("button");
    redirectBtn.innerText = "Return to Home";
    redirectBtn.onclick = () => window.location.href = "student.php";
    document.getElementById("options-container").appendChild(redirectBtn);

    updateXP();
}

// Update XP in Database
function updateXP() {
    fetch("update_xp.php", {
        method: "POST",
        body: JSON.stringify({ xp: xpPoints }),
        headers: { "Content-Type": "application/json" }
    });
}

// Start the quiz
loadQuestion(0);
startTimer();

// Navigation buttons
document.getElementById("next-btn").onclick = () => loadQuestion(++currentQuestion);
document.getElementById("prev-btn").onclick = () => loadQuestion(--currentQuestion);
