<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="icon" type="image/jpg" href="./assets/images/logo.jpg">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/parsley.css">
</head>

<body class="fade-in" style="background-image: url('../assets/images/FoodBackground.jpg')">
    <div class="main-container">
        <div class="welcome-section">
            <h1>Welcome!</h1>
            <p>Please sign up for a new account.</p>
        </div>

        <div class="form-section">
            <?php 
                if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
                    // echo "<p style='color: green; margin: 5px'>Your account registered successfully! Click on login at the bottom to get started!</p>";
                }else{
                    echo "<p style='color: red'>Something went wrong!</p>";
                }
            
            ?>
            <h2>Sign Up</h2>
            <form id="signupForm" action="../actions/register_user.php" method="POST" data-parsley-validate>
                <div class="name-group">
                    <div class="name-item">
                        <label for="firstName">First Name</label>
                        <input type="text" name="fname" id="firstName" required data-parsley-pattern="^[A-Za-z -]+$">
                        <div id="firstNameError" class="error" ></div>
                    </div>
                    <div class="name-item">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lname" id="lastName" required data-parsley-pattern="^^[A-Za-z -]+$">
                        <div id="lastNameError" class="error"></div>
                    </div>
                </div>

                <!--Email Input-->
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required data-parsley-pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$">
                <div id="emailError" class="error"></div>

                <!--Password Input-->
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required data-parsley-pattern="^(?=.*[A-Z])(?=.*\d.*\d.*\d)(?=.*[\W_]).{8,}$">
                <div id="passwordError" class="error"></div>
                <p>Password must be at least 8 characters long, contain one uppercase letter, three digits, and one special character.</p>

                <!--Confirm Password Input-->
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required data-parsley-equalto="#password">
                <div id="confirmPasswordError" class="error"></div>

                <button type="submit">Register</button>
            </form>

            <div id="successMessage" class="success-message"></div>

            <div class="toggle">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

</body>

</html>


<!--
References:
https://www.w3schools.com/howto/howto_css_login_form.asp
https://www.youtube.com/watch?v=-1oE7CWweIE&pp=ygUZaHRtbCBhbmQgY3NzIHNpZ24gdXAgcGFnZQ%3D%3D
https://www.dcpehvpm.org/E-Content/BCA/BCA-II/Web%20Technology/the-complete-reference-html-css-fifth-edition.pdf
https://www.youtube.com/watch?v=5yl75eM0Y4A&pp=ygUeZmFkZSBpbiBlZmZlY3Qgb24gaHRtbCBhbmQgY3Nz
https://www.youtube.com/watch?v=yr4K6acMcrA&pp=ygUfZm9ybSB2YWxpZGF0aW9uIGluIGh0bWwgYW5kIGNzcw%3D%3D
https://developer.mozilla.org/en-US/docs/Web/HTML
-->