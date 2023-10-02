document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.getElementById('registrationForm');
    const feedbackMessage = document.getElementById('feedbackMessage');

    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting and page reload

        // Simulate a successful registration (you should replace this with your actual registration logic)
        const isRegistered = true;

        if (isRegistered) {
            showFeedbackMessage('User successfully registered');
        } else {
            showFeedbackMessage('Registration failed'); // You can customize this message for failures
        }
    });

    function showFeedbackMessage(message) {
        feedbackMessage.textContent = message;
        feedbackMessage.style.display = 'block';

        // Automatically hide the message after 3 seconds (adjust the time as needed)
        setTimeout(function () {
            feedbackMessage.style.display = 'none';
        }, 3000);
    }
});
