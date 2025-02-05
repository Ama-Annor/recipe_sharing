<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" type="image/jpg" href="../assets/images/logo.jpg">
</head>
<body class="fade-in" style="background-image: url('../assets/images/FoodBackground.jpg');">
    <div class="main-container">
        <div class="welcome-section">
            <h1>Welcome!</h1> 
            <p>Please log in to your account or sign up if you're new.</p>
        </div> 
        <div class="form-section">
        <?php 
                if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
                    echo "<p style='color: green; margin: 5px'>You have logged in successfully! </p>";
                    header("Location: dashboard.php");
                }else{
                    // echo "<p style='color: red'>Invalid Credentials!</p>";
                }
            
            ?>

        <form id="loginForm" action="../actions/login_user.php" method="POST" data-parsley-validate>
                
            <h2>Login</h2>
            <form action="../actions/login_user.php" method="post" id="loginForm"> 
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required data-parsley-pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" >
                <div id="emailError" class="error"></div>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required required data-parsley-pattern="^(?=.*[A-Z])(?=.*\d.*\d.*\d)(?=.*[\W_]).{8,}$">
                <div id="passwordError" class="error"></div>
                
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" id="remember" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" name="login">Login</button> 
            </form>

            <div class="toggle">
                <p>Don't have an account? <a href="register.php">Sign up</a></p>
            </div>
        </div>
    </div>
<script src="../assets/js/login.js"></script>
</body>
</html>