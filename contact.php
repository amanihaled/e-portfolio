<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact & Guestbook | Batrisyia Amani</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">amanihaled</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="contact.php" class="btn-contact">Get in touch!</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content-wrapper" style="background-color: var(--white); min-height: 85vh; border-radius: 0;">
        <section class="interaction-grid">
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
                            echo "<p style='color: green; margin-bottom:15px; font-weight: bold;'>Your message has been stored effectively!</p>";
                        }
                    } else {
                        echo "<p style='color: red; margin-bottom:15px;'>Please populate all form items.</p>";
                    }
                }
                ?>

                <form action="contact.php" method="POST">
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
                        <textarea name="message" rows="6" required></textarea>
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
    </main>

    <footer>
        <p>A24CS0054 | SECV2223 Web Programming | Universiti Teknologi Malaysia</p>
    </footer>
</body>
</html>
