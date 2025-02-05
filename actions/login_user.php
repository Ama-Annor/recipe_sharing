    <?php
    include '../utils/error_config.php';
    session_start();
    include "../db/config.php"; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']); 

        if (empty($email) || empty($password)) {
            echo "<script> alert('Please fill in all fields'); window.location.href='../view/login.php'; </script>";
            exit();
        }

        // Query database for user
        $query = "SELECT user_id, `password`, fname, lname, email, `role` FROM `users` WHERE email = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Error in query: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];
            $email = $user['email'];
            $userrole = $user['role'];
            $userpass = $user['password'];

            // Verify password
            if (password_verify($password, $userpass)) {
                // Set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['userrole'] = $userrole;
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['lname'] = $user['lname'];

                // Redirect to appropriate dashboard
                // Redirect based on role
            if ($userrole == 1) { // Super Admin
                header('Location: ../view/dashboard.php');
            } else if ($userrole == 2) { // Regular Admin
                header('Location: ../view/regular_admin_dashboard.php');
            } else { // Regular user
                header('Location: ../view/recipe_feed.php');
            }
            exit();
            } else {
                // Password mismatch 

                echo "<script> alert('Wrong Password'); window.location.href='../view/login.php?msg=wrong_psswrd';</script>";
                exit();
            }
        } else {
            // Email not found
            echo "<script> alert('Wrong Email'); window.location.href='../view/login.php?msg=wrong_psswrd'; </script>";
            exit();
        }

        $stmt->close();
    } else {
        echo "<script> alert('Invalid request'); window.location.href='../view/login.php?msg=idek'; </script>";
    }

    $conn->close();
    ?>