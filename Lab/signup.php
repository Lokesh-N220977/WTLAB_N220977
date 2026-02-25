<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Exp vs Real</title>
    <link rel="stylesheet" href="index.css">

    <style>
        body {
            padding-top: 70px;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .signup-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .signup-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            max-width: 450px;
            width: 100%;
            padding: 50px;
            animation: fadeUp 0.6s ease;
        }

        .signup-card h2 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .signup-card p.subtext {
            text-align: center;
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 30px;
        }

        .signup-card input,
        .signup-card select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
            background: #fff;
        }

        .signup-card button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .signup-card button:hover {
            transform: scale(1.02);
            background: #2c3e50;
        }

        .signup-card .switch {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .signup-card .switch a {
            color: var(--accent);
            text-decoration: none;
        }

        .error {
            text-align: center;
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .success {
            text-align: center;
            color: green;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Exp<span>vs</span>Real</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="signin.php" class="btn-signin">Sign In</a></li>
            </ul>
        </div>
    </nav>

    <!-- SIGNUP CARD -->
    <section class="signup-container">
        <div class="signup-card">
            <h2>Create Account</h2>
            <p class="subtext">Join the community and share real experiences</p>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] === "exists") {
                    echo "<div class='error'>Email already exists</div>";
                } elseif ($_GET["error"] === "empty") {
                    echo "<div class='error'>All fields are required</div>";
                } elseif ($_GET["error"] === "password") {
                    echo "<div class='error'>Password must be strong (8+ chars, upper, lower, number, special)</div>";
                }
            }

            if (isset($_GET["success"])) {
                echo "<div class='success'>Account created successfully. Please sign in.</div>";
            }
            ?>

            <form action="register.php" method="POST" autocomplete="off">

                <input type="text" name="firstname" placeholder="First Name" required>

                <input type="text" name="lastname" placeholder="Last Name" required>

                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <input type="text" name="username" placeholder="Username" required>

                <input type="email" name="email" placeholder="Email Address" required>

                <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>

                <button type="submit">Sign Up</button>
            </form>

            <div class="switch">
                Already have an account?
                <a href="signin.php">Sign In</a>
            </div>
        </div>
    </section>

</body>
</html>
