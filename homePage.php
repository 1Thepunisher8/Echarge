<?php
// Handle registration form submission
require_once 'database.php';
$successMessage = '';
$errorMessage = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['name'], $_POST['password1'], $_POST['password2'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    // Validate form data
    $errors = array();
    if ($password1 !== $password2) {
        $errors[] = 'Passwords do not match.';
    }
    // Validate username: must consist of letters only
    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
        $errors[] = 'Username must consist of letters only.';
    }

    // Validate email: must end with @, then any name, then .com
    if (!preg_match('/^.*@.*\.com$/', $email)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate password: at least 8 characters long, contains a capital letter and any symbol
    if (strlen($password1) < 8 || !preg_match('/[A-Z]/', $password1) || !preg_match('/[^a-zA-Z0-9]/', $password1) || !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password1)) {
        $errors[] = 'Password must be at least 8 characters long and contain a capital letter and any symbol.';
    }

    if (count($errors) === 0) {
        $stmt = $connection->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = 'User with the same email already exists.';
        } else {
        // Hash the password
        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

        // Prepare and bind the insert statement
        $stmt = $connection->prepare('INSERT INTO users (email, name, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $email, $name, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful
            $successMessage = 'Registration successful!';
        } else {
            // Error occurred during registration
            $errorMessage = 'Error: ' . $stmt->error;
        }
    }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            $errorMessage .= $error . '<br>';
        }
    }
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    // Login form handling
    $loginEmail = $_POST['email'];
    $loginPassword = $_POST['password'];

    // Prepare and bind the select statement
    $stmt = $connection->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $loginEmail);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows === 1) {
            // User exists, verify the password
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            if (password_verify($loginPassword, $hashedPassword)) {
                // Password is correct, login successful
                $successMessage = 'Login successful!';
                // Redirect or perform any necessary actions
                // For example, you can redirect to a dashboard page:
                header('Location: typeofuser.php');
                exit();
            } else {
                // Password is incorrect
                $errorMessage = 'Invalid password.';
            }
        } else {
            // User does not exist
            $errorMessage = 'Invalid email.';
        }
    } else {
        // Error occurred during execution
        $errorMessage = 'Error: ' . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/StyleExp.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Home Page</title>
</head>
<body>
<nav class="navbar MYnavbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid d-flex justify-content-center">
            <img src="img/logoNoSlogan-01.png" alt="logo" style="height: 50px;    filter: drop-shadow(1px 1px 0px var(--text-color));">
        </div>
    </nav>
    <div class="mainPage">
    <div class="Animationcontainer">
        <div class="animationFrame" id="animationFrame">
            <img src="img/blackCar-01.png" alt="Car" class="car">  
        </div>
    </div>
<div class="logoAnimation">
        <img src="img/logoicon-01.png" alt="logo" id="logoicon">
        <img src="img/logoWord-01-01.png" alt="logo" id="logoWord">    
    </div>
    <div id="Textcontainer">
        <p class="typewriter1 animated">Enhance Your Journey with 
        </p>
    </div>
    <div id="Textcontainer2">
        <p class="typewriter2 animated">Unparalleled Charging Capabilities</p>
    </div>

    
    <div class="wrapper login">
        <div class="form-box login">
            <h2>Login</h2>
            <!-- Display error message if login failed -->
            <?php if (!empty($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="text" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember">
                    <label class="labRemember"><input type="checkbox" class="checkbox-me">Remember Me</label>
                </div>
                <a href="forget_my_password.php">Forget Password?</a>
                <br/>
                <br/>
                <button type="submit" class="btnLogin">Login</button>
                <button type="button" class="btnSingUp">Sign up</button>
            </form>
        </div>
    </div>
     
    <div class="wrapper singup">
        <div class="form-box login">
            <h2>SignUp</h2>
            <!-- Display success message if registration was successful -->
            <?php if (isset($successMessage)): ?>
                <p class="success-message"><?php echo $successMessage; ?></p>
            <?php endif; ?>
            <!-- Display error message if registration failed -->
            <?php if (!empty($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <form action="#" method="post">
                <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" id="name" name="name" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>

                    <input type="password" id="password1" name="password1" required />
                    <label for="password1">Password</label>
                </div>
                <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>

                    <input type="password" id="password2" name="password2" required />
                    <label for="password2">Password (Confirm)</label>
                </div>
                <button type="submit" class="btnSingUp">Create Account</button>
                <button type="button" class="btnLogin" id="backToLogin">Back to Login</button>
            </form>
        </div>
    </div> 
    </div>
    <footer class="mt-5">
        <div class="FooterContainer">
            <div class="row">
                <div class="col l6 s12">
                    <h5>Links</h5>
                    <ul>
                        <li>
                            <a href="Terms.php"><i>Terms and Conditions</i></a>
                        </li>
                        <li>
                            <a href="contactus.php"><i>Contact Us</i></a>
                        </li>
                        <li>
                            <a href="About_us.php"><i>About Us</i></a>
                        </li>
                    </ul>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5>Connect</h5>
                    <ul>
                        <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="FooterContainer copyRight">
            <div class="row">
                <div class="col s12">
                    <p>&copy; 2023 Electric Cars | Address | Phone Number | Email</p>
                </div>
            </div>
        </div>
    
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
            const btnPopup = document.querySelector('.btnSingUp');
            const backToLogin = document.getElementById('backToLogin');
            const login = document.querySelector('.login');
            const signup = document.querySelector('.singup');

            btnPopup.addEventListener('click', () => {
                login.classList.add('activeSingUp');
                signup.classList.add('activeSingUp');
            });
            backToLogin.addEventListener('click', () => {
                login.classList.remove('activeSingUp');
                signup.classList.remove('activeSingUp');
            });
        });
    </script>
</body>
</html>
