// login.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        // Email validation
        if (!email.value.trim()) {
            emailError.textContent = 'Email is required';
            isValid = false;
        } else if (!isValidEmail(email.value)) {
            emailError.textContent = 'Please enter a valid email address';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Password validation
        if (!password.value.trim()) {
            passwordError.textContent = 'Password is required';
            isValid = false;
        } else if (!isValidPassword(password.value)) {
            passwordError.textContent = 'Password must be at least 8 characters long, contain one uppercase letter, three digits, and one special character';
            isValid = false;
        } else {
            passwordError.textContent = '';
        }

        // Submit the form if valid
        if (isValid) {
            // SweetAlert success message
            Swal.fire({
                icon: 'success',
                title: 'Logging in...',
                text: 'Redirecting to your feed...',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                form.submit();  // Submit the form to the server
            });
        } else {
            // SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please correct the errors above.',
                confirmButtonText: 'Got it!'
            });
        }
    });

    // Validate email using regular expression
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Validate password using regular expression
    function isValidPassword(password) {
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d.*\d.*\d)(?=.*[\W_]).{8,}$/;
        return passwordRegex.test(password);
    }

    // Optional: Real-time validation feedback
    email.addEventListener('input', function() {
        if (email.value.trim()) {
            emailError.textContent = '';
        }
    });

    password.addEventListener('input', function() {
        if (password.value.trim()) {
            passwordError.textContent = '';
        }
    });
});
