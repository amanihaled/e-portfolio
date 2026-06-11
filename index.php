<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Batrisyia Amani</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">amanihaled</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="#contact" class="btn-contact">Get in touch!</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-grid">
            <div class="hero-text">
                <h1>HELLO,<br>I'M BATRISYIA!</h1>
                <div class="hero-subtext-overlay">PORTFOLIO</div>
                <p class="tagline">Bachelor of Computer Science (Bioinformatics) with Honours | Universiti Teknologi Malaysia Johor Bahru</p>
            </div>
            <div class="hero-image">
                <div class="profile-frame">
                    <img src="amanihaled.jpg" alt="Batrisyia Amani" class="profile-pic">
                </div>
            </div>
        </section>

        <div class="main-content-wrapper">
            <section class="about-flex">
                <div class="about-text">
                    <h2 class="section-title">About Me</h2>
                    <p>I am currently majoring in Bachelor of Computer Science (Bioinformatics) with Honours at UTM Johor Bahru. I am passionate about exploring how technology can solve real-world problems, especially genetics. Outside of coding, I enjoy reading mysteries—especially those by Agatha Christie.</p>
                </div>
                <div>
                    <h2 class="section-title">Personal Metrics</h2>
                    <div class="badge-container">
                        <span class="badge">19th June 2005</span>
                        <span class="badge">Female</span>
                        <span class="badge">Detail-oriented</span>
                        <span class="badge">Adaptability</span>
                    </div>
                </div>
            </section>

            <section id="contact" class="interaction-grid">
                <div>
                    <h2 class="section-title">Drop a Message</h2>
                    
                    <?php 
                    if(isset($_POST['submit_msg'])) {
                        $name = $conn->real_escape_string($_POST['name']);
                        $email = $conn->real_escape_string($_POST['email']);
                        $message = $conn->real_escape_string($_POST['message']);
                        
                        if(!empty($name) && !empty($email) && !empty($message)) {
                            $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
                            if($conn->query($query)) {
                                echo "<p style='color: green; margin-bottom:15px;'>Your message has been stored effectively!</p>";
                            }
                        } else {
                            echo "<p style='color: red; margin-bottom:15px;'>Please populate all form items.</p>";
                        }
                    }
                    ?>

                    <form action="index.php#contact" method="POST">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Message / Note</label>
                            <textarea name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" name="submit_msg" class="btn-submit">Send Message</button>
                    </form>
                </div>

                <div>
                    <h2 class="section-title">Guestbook Streams</h2>
                    <div class="guestbook-box">
                        <?php 
                        $result = $conn->query("SELECT * FROM messages ORDER BY id DESC");
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<div class='msg-card'>";
                                echo "<div class='msg-meta'><strong>".htmlspecialchars($row['name'])."</strong> &bull; ".date('d M Y, h:i A', strtotime($row['submitted_at']))."</div>";
                                echo "<p>".htmlspecialchars($row['message'])."</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p style='color:#666;'>No submission messages yet. Be the first to start the trend!</p>";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>A24CS0054 | SECV2223 Web Programming | Universiti Teknologi Malaysia</p>
    </footer>
</body>
</html>
