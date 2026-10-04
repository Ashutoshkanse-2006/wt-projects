<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments</title>
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
            <h1>Assignments</h1>
            <p>These are the upcoming assignments.</p>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Assignment 1 web technology</td>
                        <td>Complete the assignment 1 sent in google classroom today </td>
                        <td>30-08-2026</td>
                    </tr>
                    <tr>
                        <td>CN Assignment 1</td>
                        <td>Computer Networks</td>
                        <td>30-09-2026</td>
                    </tr>
                    <tr>
                        <td>DAA Assignment 1</td>
                        <td>DAA</td>
                        <td>02-10-2026</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="section-title" style="margin-top: 36px;">Assignment Details</h2>
        <div class="grid">
            <a class="card action-card" href="assigment-details.php?id=1">
                <h3>Assignment 1 Web Technology</h3>
                <p>View details &rarr;</p>
            </a>
            <a class="card action-card" href="assigment-details.php?id=2">
                <h3>Assignment 1 Computer Networks</h3>
                <p>View details &rarr;</p>
            </a>
            <a class="card action-card" href="assigment-details.php?id=3">
                <h3>Assignment 1 DAA</h3>
                <p>View details &rarr;</p>
            </a>
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
