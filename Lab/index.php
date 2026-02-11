<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expectation vs Reality</title>
    <link rel="stylesheet" href="index.css">
</head>

<body id="home">

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">Exp<span>vs</span>Real</div>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="compare.html">Compare</a></li>
                <li><a href="experience.html">Experiences</a></li>
                <li><a href="share.html">Share</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="signin.php" class="btn-signin">Sign In</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO -->
    <header class="hero">
        <h1>Expectation vs Reality</h1>
        <p class="hero-subtitle">
            Real stories from students and professionals.<br>
            Learn what no one tells you before real life hits.
        </p>
        <img src="image3.jpg" alt="Expectation vs Reality">
    </header>

    <!-- SLIDES -->
    <section class="slideshow">
        <div class="slide">
            <img src="image1.jpg" alt="">
            <p>College life isn’t freedom. It’s deadlines.</p>
        </div>
        <div class="slide">
            <img src="image2.jpg" alt="">
            <p>Your first job teaches faster than college ever did.</p>
        </div>
        <div class="slide">
            <img src="image3.jpg" alt="">
            <p>Projects succeed on planning, not motivation.</p>
        </div>
    </section>

    <!-- COMPARISON -->
    <section class="comparison" id="comparison">
        <h2>Common Myths Students Believe</h2>

        <div class="cards">
            <div class="card expectation">
                <h3>Expectation</h3>
                <p>Easy exams, fast success, instant confidence.</p>
            </div>

            <div class="card reality">
                <h3>Reality</h3>
                <p>Pressure, skill gaps, and slow, consistent growth.</p>
            </div>
        </div>
    </section>

    <!-- TABLE -->
    <section class="tables">
        <table class="expectation-table">
            <caption>Expectation</caption>
            <tr>
                <th>Aspect</th>
                <th>Belief</th>
            </tr>
            <tr>
                <td>College</td>
                <td>Free time</td>
            </tr>
            <tr>
                <td>Job</td>
                <td>High salary early</td>
            </tr>
            <tr>
                <td>Projects</td>
                <td>One-night finish</td>
            </tr>
        </table>

        <table class="reality-table">
            <caption>Reality</caption>
            <tr>
                <th>Aspect</th>
                <th>Truth</th>
            </tr>
            <tr>
                <td>College</td>
                <td>Deadlines</td>
            </tr>
            <tr>
                <td>Job</td>
                <td>Skills matter</td>
            </tr>
            <tr>
                <td>Projects</td>
                <td>Testing takes time</td>
            </tr>
        </table>
    </section>

    <!-- MEDIA -->
    <section class="media" id="media">
        <h2>Real Experiences & Perspectives</h2>

        <audio controls>
            <source src="doraemon.mp3" type="audio/mp3">
        </audio>

        <video controls width="420">
            <source src="video1.mp4" type="video/mp4">
        </video>
    </section>

    <!-- FORM -->
    <section class="share" id="share">
        <h2>Share Your Reality</h2>

        <form class="share-form">
            <input type="text" placeholder="Your Name (optional)">

            <select>
                <option>College</option>
                <option>Job</option>
                <option>Projects</option>
            </select>

            <textarea placeholder="What you expected"></textarea>
            <textarea placeholder="What actually happened"></textarea>

            <button type="submit">Submit Experience</button>
        </form>
    </section>


    <!-- Form for upload -->
     <section class="share" id="share">
        <h2>Upload your files</h2>
        <form  class="share-form" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="myfile" required>
            <button type="submit">Upload</button>
        </form>
     </section>

     <!-- download the file -->
     <?php
$dir = "uploads/";

if (!is_dir($dir)) {
    mkdir($dir);
}

$files = scandir($dir);

$realFiles = array_filter($files, function ($file) {
    return $file != "." && $file != "..";
});
?>

<?php if (count($realFiles) > 0): ?>

<section class="share">
    <h2>Download Your Files</h2>

    <?php
    $dir = "uploads/";

    if (!is_dir($dir)) {
        mkdir($dir);
    }

    $files = scandir($dir);
    ?>

    <div style="max-width:600px; margin:0 auto;">

        <?php
        foreach ($files as $file) {

            if ($file != "." && $file != "..") {

                $filepath = $dir . $file;
                $size = round(filesize($filepath) / 1024, 2);
                $modified = date("d M Y, h:i A", filemtime($filepath));
        ?>

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.05);
            margin-bottom:18px;
        ">

            <div>
                <div style="font-weight:600; color:#2c3e50;">
                    <?php echo $file; ?>
                </div>
                <div style="font-size:0.85rem; color:#7f8c8d; margin-top:5px;">
                    <?php echo $size; ?> KB • <?php echo $modified; ?>
                </div>
            </div>

            <div style="display:flex; gap:10px;">

    <!-- Download Button -->
    <form action="download.php" method="get" style="margin:0;">
        <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
        <button type="submit" style="
            padding:10px 24px;
            border-radius:25px;
            background:#2ecc71;
            color:white;
            border:none;
            cursor:pointer;
        ">
            Download
        </button>
    </form>

    <!-- Delete Button -->
    <form action="delete.php" method="post" style="margin:0;"
          onsubmit="return confirm('Are you sure you want to delete this file?');">

        <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">

        <button type="submit" style="
            padding:10px 24px;
            border-radius:25px;
            background:#e74c3c;
            color:white;
            border:none;
            cursor:pointer;
        ">
            Delete
        </button>
    </form>

</div>

        </div>

        <?php
            }
        }
        ?>

    </div>
</section>

<?php endif; ?>

    <!-- FOOTER -->
    <footer id="contact">
        <p>contact@expvsreal.com</p>
        <p>Knowing reality early saves years.</p>
    </footer>




    <script>
        const menuToggle = document.querySelector('#mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('is-active');
            navLinks.classList.toggle('active');
        });

        // Close menu when a link is clicked
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('is-active');
                navLinks.classList.remove('active');
            });
        });
    </script>
    <script src="index.js"></script>
</body>

</html>