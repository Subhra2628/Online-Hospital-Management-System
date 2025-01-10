<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
  
    <style>
        /* General Page Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    background-image: url("service.jpg");
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

/* Services Section */
.services .banner {
    background: url('hospital-services-banner.jpg') no-repeat center center/cover; /* Replace with your image */
    color: white;
    text-align: center;
    padding: 100px 20px;
}

.services .banner h1 {
    font-size: 48px;
    font-weight: bold;
    margin: 0;
    color: black;
}

.services .content {
    padding: 50px 20px;
    text-align: center;
}

.services .content h2 {
    font-size: 36px;
    color: #4CAF50;
    margin-bottom: 20px;
}

.services .content p {
    font-size: 18px;
    color: #555;
    margin-bottom: 30px;
    line-height: 1.6;
}

/* Service Cards */
.service-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.service-cards .card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    text-align: center;
}

.service-cards .card h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.service-cards .card p {
    font-size: 16px;
    color: #555;
    line-height: 1.4;
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="index_page.html" >Home</a></li>
            <li><a href="about.php" >About</a></li>
            <li><a href="services.php" class="active">Services</a></li>
            <li><a href="patient_login_form.php">Login</a></li>
            <li><a href="register_patient.php">Register</a></li>
        </ul>
    </nav>

    <!-- Services Section -->
    <section class="services">
        <div class="banner">
            <h1>Our Services</h1>
        </div>
        <div class="content">
            <h2>Comprehensive Healthcare Services</h2>
            <p>
                We are committed to providing high-quality medical services to meet all your healthcare needs. Here’s what we offer:
            </p>
            <div class="service-cards">
                <div class="card">
                    <h3>General Medicine</h3>
                    <p>Comprehensive diagnosis and treatment for common illnesses and chronic conditions.</p>
                </div>
                <div class="card">
                    <h3>Emergency Care</h3>
                    <p>24/7 emergency services for critical and life-threatening situations.</p>
                </div>
                <div class="card">
                    <h3>Diagnostic Services</h3>
                    <p>Advanced imaging and laboratory facilities for accurate diagnosis.</p>
                </div>
                <div class="card">
                    <h3>Surgery</h3>
                    <p>State-of-the-art operation theatres for major and minor surgeries.</p>
                </div>
                <div class="card">
                    <h3>Maternity Services</h3>
                    <p>Comprehensive care for mothers and newborns, including prenatal and postnatal care.</p>
                </div>
                <div class="card">
                    <h3>Pediatrics</h3>
                    <p>Dedicated care for infants, children, and adolescents.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
