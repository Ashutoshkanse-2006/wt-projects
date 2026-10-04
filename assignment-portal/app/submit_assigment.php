<?php
require_once __DIR__ . '/includes/session.php';
include("includes/db.php");
include("includes/uploads.php");
if (isset($_POST["submit_assignment"])) {
    $enrollment_number = $_POST['enrollment_number'];
    $student_name= $_POST['student_name'];
    $assignment_title = $_POST['assignment_title'];
    $temp_name = $_FILES['assignment_file']['tmp_name'];
    $file_name = $_FILES['assignment_file']['name'];
    if (save_upload($temp_name, $file_name, $enrollment_number)) {
        $INSERT_query = "INSERT INTO assignments (enrollment_number, student_name, assignment_title, assignment_file) VALUES ('$enrollment_number', '$student_name', '$assignment_title', '$file_name')";
        if (mysqli_query($conn, $INSERT_query)) {
            echo "Assignment submitted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload assignment.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Assignment</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <nav class="navbar container">
        <a class="brand" href="dashboard.php"><span class="brand-mark">AP</span><span>Assignment Portal</span></a>
        <button class="nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false"><span></span><span></span><span></span></button>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="assigments.php">Assignments</a></li>
            <li><a href="submit_assigment.php">Submit</a></li>
            <li><a href="my-submissions.php">My Submissions</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a class="nav-cta" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="container auth-wrapper">
        <div class="card auth-card wide">
            <h1>Submit Assignment</h1>
            <p class="intro">Fill in your details and upload your completed work.</p>

            <form method="POST" action="" enctype="multipart/form-data">

                <div class="form-grid">

                    <div class="form-group">
                        <label for="enrollment_number">Enrollment Number</label>
                        <input class="form-control" type="text" id="enrollment_number" name="enrollment_number" required>
                    </div>

                    <div class="form-group">
                        <label for="student_name">Student Name</label>
                        <input class="form-control" type="text" id="student_name" name="student_name" required>
                    </div>

                    <div class="form-group full">
                        <label for="assignment_title">Assignment Title</label>
                        <input class="form-control" type="text" id="assignment_title" name="assignment_title" required>
                    </div>

                    <div class="form-group full">
                        <label for="assignment_file">Assignment File</label>
                        <input class="form-control" type="file" id="assignment_file" name="assignment_file" required>
                    </div>

                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit" name="submit_assignment" value="Submit Assignment">Submit Assignment</button>
                    <a class="btn btn-outline" href="dashboard.php">Back to Dashboard</a>
                </div>

            </form>
        </div>
    </div>
</main>

<footer class="site-footer">
    <div class="container">
        <p><strong>Student Assignment Submission Portal</strong></p>
        <p>Indus University &middot; Department of Computer Science &amp; Engineering</p>
    </div>
</footer>

<script src="javascript/script.js"></script>
</body>
</html>
