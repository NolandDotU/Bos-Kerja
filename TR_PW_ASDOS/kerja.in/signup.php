<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
  $user_type = $_POST["user_type"];

  $stmt = $conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
  
  if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
  }

  $stmt->bind_param("ssss", $username, $email, $password, $user_type);

  if ($stmt->execute()) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Akun berhasil terdaftar. <a href='signin.php' class='alert-link'>Masuk</a>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
  } else {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Gagal mendaftar akun.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BosKerja - Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="../logo/kerjain_icon_whitebg.png">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <img class="logo" src="../logo/kerjain_logo_croped.png" alt="logo">
      <a class="navbar-brand" href="index.html"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link off" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link off" href="jobs.html">Jobs</a></li>
          <li class="nav-item"><a class="nav-link off" href="about.html">About</a></li>
          <li class="nav-item-btn"><a class="nav-link text-white" href="signin.php">Sign Up</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sign Up Form -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Sign Up</h2>
      <form class="row g-3" method="POST" action="signup.php">
        <center>
          <img class="logo-form" src="../logo/kerjain_icon_whitebg.png" alt="logo">
        </center>
        <div class="col-md-12">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
        </div>
        <div class="col-md-12">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="col-md-12">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <div class="col-md-12">
          <label for="user_type" class="form-label">User Type</label>
          <select class="form-control" name="user_type" id="user_type" required>
            <option value="">Select user type</option>
            <option value="job_seeker">Job Seeker</option>
            <option value="recruiter">Recruiter</option>
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
        <div class="col-12 mt-3">
          <p>Already have an account? <a href="signin.php">Sign in</a></p>
        </div>
      </form>
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
