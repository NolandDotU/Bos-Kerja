<?php
include "connect.php";
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: signin.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BosKerja - Jobs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/stylejob.css">
  <link rel="shortcut icon" href="../logo/kerjain_icon_whitebg.png">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
          <li class="nav-item"><a class="nav-link off" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="jobs.php">Jobs</a></li>
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

  <div class="container">
    <!-- Search and Filter Section -->
    <div class="search-and-filter-section mb-4">
      <div class="row">
        <!-- Sidebar Filters -->
        <aside class="col-lg-3 mb-4">
          <div class="sidebar bg-white p-4 shadow rounded">
            <h3 class="mb-3">Filters</h3>
            <button class="btn-reset btn-link p-2 mb-3" onclick="resetFilters()">Reset all</button>


            <div>
              <label>
                <input class="form-check-input" type="checkbox" id="showFavorites"> Show Favorites Only
              </label>
            </div>
            <br>

            <div class="mb-4">
              <h4 class="h6">Work schedule</h4>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="full-time" checked>
                <label class="form-check-label" for="full-time">Full-time</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="part-time" checked>
                <label class="form-check-label" for="part-time">Part-time</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="internship">
                <label class="form-check-label" for="internship">Internship</label>
              </div>
            </div>

            <!-- Salary range section -->
            <div class="mb-4">
              <h4 class="h6">Salary range</h4>
              <input type="range" class="slide" id="salaryRange" min="2500" max="20000" step="500" value="2500">
              <div class="d-flex justify-content-between">
                <span id="salaryMinValue">$2,500</span>
                <span id="salaryMaxValue">$20,000</span>
              </div>
              <div class="mt-2">
                <span>Selected Salary: <strong id="salaryValue">$2,500</strong></span>
              </div>
            </div>

            <!-- Work Style Filters -->
            <div class="mb-4">
              <h4 class="h6">Work style</h4>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="office" checked>
                <label class="form-check-label" for="office">Office</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="hybrid" checked>
                <label class="form-check-label" for="hybrid">Hybrid</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remote">
                <label class="form-check-label" for="remote">Remote</label>
              </div>
            </div>

        </aside>

        <!-- Job Listings -->
        <section class="col-lg-9">
          <!-- Search Bar -->
          <div class="search-bar py-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for jobs..." onkeyup="filterJobs()">
          </div>

          <!-- Job Cards -->
          <div class="row" id="jobCardsContainer">
            <!-- Munucul disini nanti -->
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Modal Kalau Mau Hapus Fav -->
  <div class="modal fade" id="removeFavoriteModal" tabindex="-1" aria-labelledby="removeFavoriteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeFavoriteModalLabel">Remove from Favorites</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to remove this job from your favorites?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-modal-cancel " data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-modal-remove" id="confirmRemoveBtn">Remove</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <footer class="py-3 bg-dark text-white text-center">
    <div class="container">
      <p class="mb-0">© 2024 BosKerja. All rights reserved.</p>
    </div>
  </footer>

  <!--Script external  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.js"></script>

  <!-- Bootstrap JS & Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <!-- AOS buat animasi -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>