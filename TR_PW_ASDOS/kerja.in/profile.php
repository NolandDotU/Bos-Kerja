<?php
include 'connect.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}

// Fetch user details from the database
$username = $_SESSION["username"];
$stmt = $conn->prepare("SELECT email, user_type, full_name, phone, address, bio, education, work_experience, skills, projects FROM users WHERE username = ?");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($email, $user_type, $full_name, $phone, $address, $bio, $education, $work_experience, $skills, $projects);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
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
            <a class="navbar-brand fw-bold" href="index.php">BosKerja</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="jobs.php">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <?php if (isset($_SESSION["username"])): ?>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="profile.php">
                                <img src="path/to/profile_picture.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px;">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-white" href="signin.php">Sign In</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($full_name); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($user_type); ?></p>
                        <a href="#" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Profile Details
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Personal Information</h5>
                        <p class="card-text"><strong>Full Name:</strong> <?php echo htmlspecialchars($full_name); ?></p>
                        <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                        <p class="card-text"><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                        <p class="card-text"><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
                        <h5 class="card-title mt-4">About Me</h5>
                        <p class="card-text"><?php echo htmlspecialchars($bio); ?></p>
                        <h5 class="card-title mt-4">Education</h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($education)); ?></p>
                        <h5 class="card-title mt-4">Work Experience</h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($work_experience)); ?></p>
                        <h5 class="card-title mt-4">Skills</h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($skills)); ?></p>
                        <h5 class="card-title mt-4">Projects</h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($projects)); ?></p>
                    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>