<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="description"
      content="Complaint Management System - Easily register and track complaints online."
    />
    <meta name="author" content="" />

    <title>ResolveX - Complaint Management System</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      :root {
        --primary-color: #2563eb;
        --secondary-color: #1e40af;
        --accent-color: #3b82f6;
        --light-color: #f8fafc;
        --dark-color: #0f172a;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --navbar-bg: #2c3e50;
      }

      body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f1f5f9;
        color: #334155;
        line-height: 1.6;
        padding-top: 50px; /* Add padding to account for fixed navbar */
      }

      .navbar-inverse {
        background: linear-gradient(135deg, var(--navbar-bg), #1a2530);
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      }

      .navbar-inverse .navbar-brand {
        color: white !important;
        font-weight: 700;
        font-size: 1.8rem;
      }

      .navbar-inverse .navbar-nav > li > a {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 4px;
        margin: 5px 2px;
        padding: 10px 15px;
      }

      .navbar-inverse .navbar-nav > li > a:hover,
      .navbar-inverse .navbar-nav > li > a:focus {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.15) !important;
      }

      .navbar-inverse .navbar-toggle {
        border-color: rgba(255, 255, 255, 0.2);
      }

      .navbar-inverse .navbar-toggle:hover,
      .navbar-inverse .navbar-toggle:focus {
        background-color: rgba(255, 255, 255, 0.1);
      }

      .navbar-inverse .navbar-toggle .icon-bar {
        background-color: white;
      }

      .hero-section {
        background: linear-gradient(
            rgba(37, 99, 235, 0.85),
            rgba(30, 64, 175, 0.9)
          ),
          url("img/c2.jpg");
        background-size: cover;
        background-position: center;
        color: white;
        padding: 5rem 0;
        text-align: center;
        margin-top: 0; /* Remove margin since we added body padding */
      }

      .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      }

      .hero-subtitle {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
      }

      .btn-hero {
        background: linear-gradient(135deg, #ff6b6b, #ff8e53);
        border: none;
        padding: 15px 40px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      .btn-hero:hover {
        background: linear-gradient(135deg, #ff8e53, #ff6b6b);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(255, 107, 107, 0.6);
        color: white;
      }

      .btn-hero:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.3);
      }

      .features-section {
        padding: 5rem 0;
      }

      .section-title {
        text-align: center;
        font-weight: 700;
        margin-bottom: 3rem;
        color: var(--dark-color);
        position: relative;
      }

      .section-title:after {
        content: "";
        display: block;
        width: 80px;
        height: 4px;
        background: var(--primary-color);
        margin: 15px auto;
        border-radius: 2px;
      }

      .feature-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #e2e8f0;
      }

      .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      }

      .feature-icon {
        width: 70px;
        height: 70px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--primary-color);
        font-size: 1.8rem;
      }

      .feature-title {
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark-color);
      }

      .cta-section {
        background: linear-gradient(
          135deg,
          var(--primary-color),
          var(--secondary-color)
        );
        color: white;
        padding: 4rem 0;
        text-align: center;
        border-radius: 0;
      }

      .cta-title {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1.5rem;
      }

      .btn-cta {
        background: linear-gradient(135deg, #ff6b6b, #ff8e53);
        border: none;
        padding: 15px 40px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
      }

      .btn-cta:hover {
        background: linear-gradient(135deg, #ff8e53, #ff6b6b);
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(255, 107, 107, 0.6);
        color: white;
      }

      footer {
        background-color: var(--dark-color);
        color: white;
        padding: 2rem 0;
        text-align: center;
      }

      .footer-content {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .social-links {
        margin: 1rem 0;
      }

      .social-links a {
        color: white;
        font-size: 1.5rem;
        margin: 0 10px;
        transition: all 0.3s ease;
      }

      .social-links a:hover {
        color: var(--accent-color);
        transform: translateY(-3px);
      }

      @media (max-width: 768px) {
        .hero-title {
          font-size: 2.2rem;
        }

        .hero-subtitle {
          font-size: 1.2rem;
        }

        .navbar-brand {
          font-size: 1.5rem;
        }
      }
    </style>
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <i class="fas fa-balance-scale"></i> ResolveX
          </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="users/index.php"
                ><i class="fas fa-user"></i> User Login</a
              >
            </li>
            <li>
              <a href="users/registration.php"
                ><i class="fas fa-user-plus"></i> Register</a
              >
            </li>
            <li>
              <a href="admin/index.php"
                ><i class="fas fa-lock"></i> Admin Login</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <h1 class="hero-title">Resolve Your Complaints Effortlessly</h1>
        <p class="hero-subtitle">
          A modern platform to register, track, and resolve your complaints with
          ease. Get your issues addressed quickly and efficiently.
        </p>
        <a href="users/registration.php" class="btn btn-hero btn-lg">
          <i class="fas fa-paper-plane"></i> Get Started
        </a>
      </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
      <div class="container">
        <h2 class="section-title">How It Works</h2>
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="feature-card text-center">
              <div class="feature-icon">
                <i class="fas fa-edit"></i>
              </div>
              <h3 class="feature-title">Register Complaint</h3>
              <p>
                Create a detailed complaint with necessary information and
                documents in just a few minutes.
              </p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="feature-card text-center">
              <div class="feature-icon">
                <i class="fas fa-sync-alt"></i>
              </div>
              <h3 class="feature-title">Track Progress</h3>
              <p>
                Monitor the status of your complaint in real-time and receive
                updates on resolution progress.
              </p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="feature-card text-center">
              <div class="feature-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <h3 class="feature-title">Get Resolution</h3>
              <p>
                Receive timely resolution to your complaints and close the loop
                with satisfaction feedback.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <h2 class="cta-title">Ready to Resolve Your Complaints?</h2>
        <p class="lead">
          Join thousands of satisfied users who have successfully resolved their
          issues with our platform.
        </p>
        <a href="users/registration.php" class="btn btn-cta btn-lg">
          <i class="fas fa-user-plus"></i> Create Account
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="footer-content">
          <h3>ResolveX - Complaint Management System</h3>
          <p>Efficiently managing complaints for a better tomorrow</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
          <p>&copy; 2025 ResolveX. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
      // Add smooth scrolling to all links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
          });
        });
      });

      // Add animation to feature cards on scroll
      document.addEventListener("DOMContentLoaded", function () {
        const featureCards = document.querySelectorAll(".feature-card");

        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = "translateY(0)";
              }
            });
          },
          { threshold: 0.1 }
        );

        featureCards.forEach((card) => {
          card.style.opacity = 0;
          card.style.transform = "translateY(20px)";
          card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
          observer.observe(card);
        });
      });
    </script>
  </body>
</html>
