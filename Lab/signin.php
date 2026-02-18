<?php
session_start();

// If already logged in, redirect to index
if (isset($_SESSION["user_id"]) || isset($_SESSION["google_id"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Expectation vs Reality</title>
    <link rel="stylesheet" href="index.css">

    <style>
        body {
            padding-top: 70px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .signin-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .signin-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            max-width: 900px;
            width: 100%;
            min-height: 500px;
        }

        .signin-visual {
            flex: 1;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signin-form-wrapper {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }

        .google-btn {
            margin-top: 20px;
            background-color: #db4437;
            color: white;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .google-btn:hover {
            background-color: #c23321;
        }

        @media (max-width: 768px) {
            .signin-card {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Exp<span>vs</span>Real</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="signin.php" class="btn-signin">Sign In</a></li>
            </ul>
        </div>
    </nav>

    <section class="signin-container">
        <div class="signin-card">

            <div class="signin-visual">
                <h2>Welcome Back</h2>
                <p>Join our community and explore real experiences.</p>
            </div>

            <div class="signin-form-wrapper">
                <h3 class="form-title">Account Login</h3>

                <!-- Normal Login -->
                <form action="php/login.php" method="POST" autocomplete="off">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Sign In</button>
                </form>

                <!-- Google Login (OUTSIDE form) -->
                <a href="google_login.php" class="google-btn">
                    Sign in with Google
                </a>

                <p style="text-align:center; margin-top:15px;">
                    Don't have an account?
                    <a href="signup.php">Sign Up</a>
                </p>

            </div>
        </div>
    </section>

</body>
</html>