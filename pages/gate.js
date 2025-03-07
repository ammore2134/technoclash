// Function to start the quiz
function startQuiz(quizId) {
    window.location.href = 'start_quiz.php?quiz_id=' + quizId;
}

// Function to filter quizzes by stream
document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll(".filter-section a");

    filters.forEach(filter => {
        filter.addEventListener("click", function (e) {
            e.preventDefault();
            const stream = this.getAttribute("href").split("=")[1];

            fetchQuizzes(stream);
        });
    });
});

function fetchQuizzes(stream) {
    fetch(`gate_dashboard.php?stream=${stream}`)
        .then(response => response.text())
        .then(html => {
            document.querySelector(".quiz-container").innerHTML = html;
        })
        .catch(error => console.error("Error fetching quizzes:", error));
}
