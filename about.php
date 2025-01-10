<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Page Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    background-image: url(hospital_about.jpg);
    background-repeat: no-repeat;
}

/* Navigation Bar */
nav ul {
    list-style: none;
    padding: 0;
    background-color: #333;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 10px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 14px 20px;
    display: block;
}

nav ul li a:hover, nav ul li a.active {
    background-color: #575757;
}

/* About Us Section */
.about-us .banner {
    background: url('hospital-banner.jpg') no-repeat center center/cover; /* Replace with your image */
    color: white;
    text-align: center;
    padding: 100px 20px;
}

.about-us .banner h1 {
    font-size: 48px;
    font-weight: bold;
    margin: 0;
}

.about-us .content {
    padding: 50px 20px;
    text-align: center;
}

.about-us .content h2 {
    font-size: 36px;
    color: #4CAF50;
    margin-bottom: 20px;
}

.about-us .content p {
    font-size: 18px;
    color: #555;
    margin-bottom: 20px;
    line-height: 1.6;
}

.about-us .content h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.about-us .contact-details {
    margin-top: 30px;
    padding: 20px;
    background-color: #f0f0f0;
    border-radius: 10px;
    display: inline-block;
    text-align: left;
}

.about-us .contact-details p {
    font-size: 18px;
    margin: 10px 0;
    color: #444;
}

.about-us .contact-details strong {
    color: #000;
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="index_page.html">Home</a></li>
            <li><a href="about.php" class="active">About Us</a></li>
            <li><a href="patient_login_form.php">Login</a></li>
            <li><a href="register_patient.php">Register</a></li>
        </ul>
    </nav>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="banner">
            <h1>About Our Hospital</h1>
        </div>
        <div class="content">
            <h2>Welcome to ABC Hospital</h2>
            <p>
                At ABC Hospital, we are dedicated to providing the best healthcare services with a focus on compassion, quality, and innovation. 
                Our team of experienced professionals ensures that every patient receives personalized care tailored to their needs.
            </p>
            <h3>Our Mission</h3>
            <p>
                To deliver exceptional healthcare services and improve the well-being of our community by adhering to the highest standards of medical excellence.
            </p>
            <h3>Our Vision</h3>
            <p>
                To be a leading healthcare institution known for providing advanced and patient-centered medical care.
            </p>
            <div class="contact-details">
                <h2>Contact Information</h2>
                <p><strong>Phone:</strong> 7547972652</p>
                <p><strong>Email:</strong> subhrasv@gmail.com</p>
                <p><strong>Address:</strong> Kaichar, Hospital Road, Burdwan, West Bengal, PIN-713143</p>
            </div>
        </div>
    </section>
</body>
</html>
