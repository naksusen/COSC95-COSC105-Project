<?php require('conn.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>G! Arat Na</title>
    <link rel="icon" type="image/x-icon" href="images/G!.png">
    <style>      
        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            z-index: 10;
            padding: 5px;
            pointer-events: auto;
        }
        
        .toggle-password:hover {
            color: #666;
        }

/* 
        .input-field input {
            transition: box-shadow 0.3s ease;
        }
        .input-field input:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 55px;
        } */

        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign in Form -->
                <form action="login_register.php" method="POST" class="sign-in-form" onsubmit="return validateSignIn(event)">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Email or Username" name="email_username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" class="password-input" required />
                        <i class="fa-regular fa-eye-slash toggle-password"></i>
                    </div>
                    <input type="submit" name="login" value="Login" class="btn solid" />
                </form>

                <!-- Sign up Form -->
                <form action="login_register.php" method="POST" class="sign-up-form" onsubmit="return validateSignUp(event)">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" id="username" name="username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" id="email" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Student Number" id="studentNum" name="studentNum" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" class="password-input" required />
                        <i class="fa-regular fa-eye-slash toggle-password"></i>
                    </div>
                    <input type="submit" name="signup" class="btn" value="Sign up" />
                    <!--<p class="social-text">Or Sign up with social platforms</p>
                      <div class="social-media">
                        <a href="#" class="social-icon">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                          <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                          <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                          <i class="fab fa-linkedin-in"></i>
                        </a>
                      </div>-->
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here?</h3>
                    <p>Sign up for an account to register! It's free and only takes a minute!</p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="images/log.svg" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us?</h3>
                    <p>Sign in to jump right into registration. It's gonna be epic!</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="images/register.svg" class="image" alt="">
            </div>
        </div>
    </div>

    <script src="login.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');

            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const passwordInput = this.previousElementSibling;
                    toggleFieldVisibility(passwordInput, this);
                });
            });

            function toggleFieldVisibility(input, icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            }
        });

        function validateSignIn(event) {
            const form = event.target;
            const emailUsername = form.querySelector('[name="email_username"]');
            const password = form.querySelector('[name="password"]');

            if (!emailUsername.value.trim() || !password.value.trim()) {
                alert('Please fill in all required fields');
                return false;
            }
            return true;
        }

        function validateSignUp(event) {
            const form = event.target;
            const username = form.querySelector('#username');
            const email = form.querySelector('#email');
            const studentNum = form.querySelector('#studentNum');
            const password = form.querySelector('#password');

            if (!username.value.trim() || !email.value.trim() || 
                !studentNum.value.trim() || !password.value.trim()) {
                alert('Please fill in all required fields');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>