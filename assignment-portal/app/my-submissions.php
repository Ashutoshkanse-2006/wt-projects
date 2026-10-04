<?php
require_once __DIR__ . '/includes/session.php';

if(!isset($_SESSION['student_name']))
{
    header("Location: login.php");
    exit();
}

include("includes/db.php");

$student_name = $_SESSION['student_name'];
$enrollment_number = $_SESSION['enrollment_number'];

$query = "SELECT * FROM assignments WHERE student_name='$student_name'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Submissions</title>
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
    <div class="container">

        <div class="page-header">
            <h1>My Submitted Assignments</h1>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Assignment Title</th>
                        <th>File Name</th>
                        <th>Submission Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
<?php

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        ?>
                    <tr>
                        <td><?php echo $row['assignment_title']; ?></td>
                        <td><a href="download.php?name=<?php echo urlencode($row['assignment_file']); ?>"><?php echo $row['assignment_file']; ?></a></td>
                        <td><?php echo $row['submitted_at']; ?></td>
                        <td><span class="badge">Submitted</span></td>
                    </tr>
        <?php
    }
}
else
{
    ?>
                    <tr>
                        <td colspan="4" class="empty-row">No submissions found.</td>
                    </tr>
    <?php
}

?>
                </tbody>
            </table>
        </div>

        <div class="form-actions">
            <a class="btn btn-primary" href="uploads/filename.pdf" target="_blank">View File</a>
            <a class="btn btn-outline" href="dashboard.php">Back to Dashboard</a>
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
