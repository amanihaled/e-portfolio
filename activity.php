<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities | Batrisyia Amani</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav class="navbar">
            <div class="logo">amanihaled</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="activity.php">Activity</a></li>
                <li><a href="contact.php" class="btn-contact">Get in touch!</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content-wrapper" style="background-color: var(--white); min-height: 85vh; border-radius: 0;">
        
        <!-- Part 1: Emcee Experience Dynamic Section -->
        <section style="margin-bottom: 70px;">
            <h2 class="section-title">Emceeing Experience</h2>
            <p style="color: #333; margin-bottom: 30px; font-size: 1.05rem; max-width: 700px;">
                Commanding the stage with clarity, poise, and dynamic energy. I specialize in anchoring university events, formal ceremonies, and interactive student forums.
            </p>
            
            <div class="project-flex-container">
                <?php 
                $emcee_result = $conn->query("SELECT * FROM emcee_experience ORDER BY id DESC");
                if($emcee_result && $emcee_result->num_rows > 0) {
                    while($row = $emcee_result->fetch_assoc()) {
                        echo "<article class='project-card' style='border-left: 5px solid var(--orange-accent);'>";
                        echo "<div style=\"font-size: 0.85rem; color: #666; margin-bottom: 5px; font-family: 'Arial', sans-serif; font-weight: bold;\">".htmlspecialchars($row['category'])." (".$row['event_date'].")</div>";
                        echo "<h3>".htmlspecialchars($row['title'])."</h3>";
                        echo "<p style='margin-bottom:0;'>".htmlspecialchars($row['description'])."</p>";
                        echo "</article>";
                    }
                } else {
                    echo "<p style='color: #666;'>No emcee experiences recorded yet.</p>";
                }
                ?>
            </div>
        </section>

        <!-- Part 2: Malay Poetry Showcase Dynamic Section -->
        <section>
            <h2 class="section-title">Karya Puisi Melayu</h2>
            <p style="color: #333; margin-bottom: 30px; font-size: 1.05rem; max-width: 700px;">
                A celebration of rhythm, metaphor, and heritage. Writing poetry allows me to explore deeper emotional nuances and preserve the elegant cadence of literature.
            </p>

            <div class="project-flex-container" style="grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 30px;">
                <?php 
                $poetry_result = $conn->query("SELECT * FROM poems ORDER BY id DESC");
                if($poetry_result && $poetry_result->num_rows > 0) {
                    while($row = $poetry_result->fetch_assoc()) {
                        echo "<div style='background: #EAE8E2; padding: 40px; border-radius: 16px; border-top: 4px solid var(--bruised-plum); text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.02);'>";
                        echo "<h3 style=\"font-family: 'Times New Roman', serif; color: var(--bruised-plum); margin-bottom: 20px; font-size: 1.5rem; letter-spacing: 1px;\">".htmlspecialchars($row['title'])."</h3>";
                        
                        // Converts saved structural line breaks (\n) into beautiful HTML line drops (<br>)
                        $formatted_content = nl2br(htmlspecialchars($row['content']));
                        echo "<p style='font-style: italic; line-height: 2; color: #222; font-size: 1.1rem;'>".$formatted_content."</p>";
                        
                        echo "<div style=\"margin-top: 25px; font-size: 0.85rem; color: #666; font-family: 'Arial', sans-serif; letter-spacing: 1px;\">&mdash; Batrisyia Amani (".$row['written_date'].")</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p style='color: #666;'>No poems added yet.</p>";
                }
                ?>
            </div>
        </section>

    </main>

    <footer>
        <p>© A24CS0054 | Universiti Teknologi Malaysia</p>
	<div class="social-links">
            <a href="https://github.com/amanihaled">GitHub | <a href="https://www.instagram.com/amanihaled/">Instagram</a>
        </div>
    </footer>
</body>
</html>
