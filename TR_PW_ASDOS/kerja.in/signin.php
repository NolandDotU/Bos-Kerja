<?php
include "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      // Start a new session and save user information
      $_SESSION["user_id"] = $id;
      $_SESSION["username"] = $username;
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid password.";
    }
  } else {
    $error = "No account found with that email.";
  }
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
          <li class="nav-item"><a class="nav-link off" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link off" href="jobs.php">Jobs</a></li>
          <li class="nav-item"><a class="nav-link off" href="about.php">About</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sign Up Form -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Sign In</h2>
      <form class="row g-3" method="POST" action="signin.php">
        <center>
        <img class="logo-form" src="../logo/kerjain_logo_croped.png" alt="logo">
      </center>

        <div class="col-md-12">
          <label for="username" class="form-label">Username</label>
          <input type="username" class="form-control" name="username" id="username" placeholder="Enter your username" required>
        </div>
        <div class="col-md-12">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Sign In</button>
        </div>
        <?php if (isset($error)): ?>
        <div class="col-12 mt-3">
          <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="col-12 mt-3">
            <p>Already have an account? <a href="signup.php">Sign Up</a></p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
