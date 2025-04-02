<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "gtbit_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTBIT - Guru Tegh Bahadur Institute of Technology</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1 class="logo">Guru Tegh Bahadur Institute of Technology</h1>
        <p class="tagline">Shaping Tomorrow's Technology Leaders</p>
    </header>
    
    <div class="container">
        <section id="departments">
            <h2>Our Departments</h2>
            <div class="cards-container">
                <?php
                $dept_query = "SELECT * FROM departments";
                $dept_result = $conn->query($dept_query);
                while ($row = $dept_result->fetch_assoc()) {
                    echo "<div class='card'><div class='card-title'>{$row['name']}</div></div>";
                }
                ?>
            </div>
        </section>
        
        <section id="courses">
            <h2>Academic Programs</h2>
            <div class="cards-container">
                <?php
                $course_query = "SELECT courses.name, departments.name AS department FROM courses 
                                JOIN departments ON courses.department_id = departments.id";
                $course_result = $conn->query($course_query);
                while ($row = $course_result->fetch_assoc()) {
                    echo "<div class='card'><div class='card-title'>{$row['name']}</div><div class='card-info'>Department: {$row['department']}</div></div>";
                }
                ?>
            </div>
        </section>
        
        <section id="faculty">
            <h2>Our Distinguished Faculty</h2>
            <div class="cards-container">
                <?php
                $faculty_query = "SELECT faculty.name, faculty.designation, departments.name AS department FROM faculty 
                                 JOIN departments ON faculty.department_id = departments.id";
                $faculty_result = $conn->query($faculty_query);
                while ($row = $faculty_result->fetch_assoc()) {
                    echo "<div class='faculty-card'><div class='faculty-info'><div class='faculty-name'>{$row['name']}</div><div class='faculty-title'>{$row['designation']} ({$row['department']})</div></div></div>";
                }
                ?>
            </div>
        </section>
        
        <section id="contact">
            <h2>Get In Touch</h2>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $subject = $_POST['subject'];
                $message = $_POST['message'];
                
                $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, $message);
                if ($stmt->execute()) {
                    echo "<div class='success-message'><strong>Success!</strong> Your message has been sent successfully!</div>";
                }
                $stmt->close();
            }
            ?>
            
            <div class="contact-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </section>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <h3>Guru Tegh Bahadur Institute of Technology</h3>
                <p>G-3 Block, Rajouri Garden, New Delhi - 110064</p>
                <div class="social-links">
                    <a href="#">f</a>
                    <a href="#">t</a>
                    <a href="#">i</a>
                    <a href="#">in</a>
                </div>
                <div class="copyright">&copy; 2025 GTBIT. All rights reserved.</div>
            </div>
        </div>
    </footer>
    
    <?php $conn->close(); ?>
</body>
</html>
