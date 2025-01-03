<?php
include 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BosKerja - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="shortcut icon" href="../logo/kerjain_icon_whitebg.png">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <img class="logo" src="../logo/kerjain_logo_croped.png" alt="logo">
      <a class="navbar-brand fw-bold" href="index.html"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link off" href="jobs.php">Jobs</a></li>
          <li class="nav-item"><a class="nav-link off" href="about.php">About</a></li>
          <?php if (isset($_SESSION["username"])): ?>
            <li class="nav-item">
              <a class="nav-link off d-flex align-items-center" href="profile.php">
                <img src="path/to/profile_picture.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px;">
                Profile
              </a>
            </li>
            <li class="nav-item"><a class="nav-link off" href="logout.php">Log Out</a></li>
          <?php else: ?>
            <li class="nav-item-btn"><a class="nav-link  text-white" href="signin.php">Sign In</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero position-relative d-flex align-items-center;">
    <div class="container text-center text-white">
      <h1 class="display-4 fw-bold">Find Your Dream Job</h1>
      <p class="lead mt-3">Explore opportunities from top companies around the world. Start your journey today!</p>
      <a href="jobs.html" class="hero-btn btn-lg mt-3">Explore Jobs</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4 fw-bold">What You Can Do Here</h2>
      <div class="row g-4">
        <!-- Feature 1 -->
        <div class="col-md-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="bi bi-briefcase-fill" style="font-size: 3rem; color: #6A42C2;"></i>
              <h5 class="card-title mt-3">Browse Jobs</h5>
              <p class="card-text">Search and filter job listings to find the perfect match for your career goals.</p>
            </div>
          </div>
        </div>
        <!-- Feature 2 -->
        <div class="col-md-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="bi bi-person-fill" style="font-size: 3rem; color: #6A42C2;"></i>
              <h5 class="card-title mt-3">Create a Profile</h5>
              <p class="card-text">Build a professional profile and showcase your skills to attract recruiters.</p>
            </div>
          </div>
        </div>
        <!-- Feature 3 -->
        <div class="col-md-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="bi bi-envelope-fill" style="font-size: 3rem; color: #6A42C2;"></i>
              <h5 class="card-title mt-3">Apply Easily</h5>
              <p class="card-text">Submit applications quickly and track your progress with ease.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testi-->
  <section class="py-5" style="background: white;">
    <div class="container text-center">
      <h2 class="mb-4 fw-bold">What Our Users Say</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <blockquote class="blockquote">
            <p>"This platform helped me land my dream job in just two weeks!"</p>
            <footer class="blockquote-footer">Sarah J.</footer>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote class="blockquote">
            <p>"The interface is user-friendly, and the job recommendations are spot-on."</p>
            <footer class="blockquote-footer">David K.</footer>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote class="blockquote">
            <p>"As a recruiter, I found it easy to post jobs and connect with top talent."</p>
            <footer class="blockquote-footer">Emily R.</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-3 bg-dark text-white text-center">
    <div class="container">
      <p class="mb-0">© 2024 BosKerja. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>