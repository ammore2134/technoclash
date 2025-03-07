document.addEventListener("DOMContentLoaded", function () {
    // Handle Delete Quiz Confirmation
    const deleteButtons = document.querySelectorAll(".delete-btn");
    
    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const quizId = this.dataset.quizId;
            const confirmDelete = confirm("Are you sure you want to delete this quiz?");
            if (confirmDelete) {
                window.location.href = `delete_quiz.php?id=${quizId}`;
            }
        });
    });

    // Toggle Sidebar for Mobile
    const toggleButton = document.querySelector(".toggle-menu");
    const sidebar = document.querySelector(".sidebar");

    toggleButton.addEventListener("click", function () {
        sidebar.classList.toggle("active");
    });
});
