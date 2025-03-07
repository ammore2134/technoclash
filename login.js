document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".login-btn").addEventListener("click", function (event) {
        let usernameEmail = document.querySelector("input[name='username_email']").value.trim();
        let password = document.querySelector("input[name='password']").value.trim();

        if (usernameEmail === "" || password === "") {
            alert("Please enter both Username/Email and Password.");
            event.preventDefault();
        }
    });
});
