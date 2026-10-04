<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("includes/db.php");

if(isset($_POST['register']))
{
    $student_name = $_POST['student_name'];
    $enrollment_number = $_POST['enrollment_number'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    echo "Reached Here 1<br>";

    if($password === $confirm_password)
    {
        echo "Reached Here 2<br>";

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO students
        (student_name, enrollment_number, email, department, semester, password)
        VALUES
        ('$student_name','$enrollment_number','$email','$department','$semester','$hashed_password')";

        if(mysqli_query($conn, $insert_query))
        {
            echo "INSERT SUCCESS";
        }
        else
        {
            die(mysqli_error($conn));
        }
    }
    else
    {
        echo "Passwords do not match";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <nav class="navbar container">
        <a class="brand" href="index.php"><span class="brand-mark">AP</span><span>Assignment Portal</span></a>
        <button class="nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false"><span></span><span></span><span></span></button>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="faculty/login.php">Faculty Login</a></li>
            <li><a href="login.php">Student Login</a></li>
            <li><a class="nav-cta" href="register.php">Register</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="container auth-wrapper">
        <div class="card auth-card wide">
            <h1>Student Registration</h1>
            <p class="intro">Fill the form to register as a student in the portal.</p>

            <form method="POST" action="">

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="student_name">Student Name</label>
                        <input class="form-control" type="text" id="student_name" name="student_name">
                    </div>

                    <div class="form-group">
                        <label for="enrollment_number">Enrollment Number</label>
                        <input class="form-control" type="number" id="enrollment_number" name="enrollment_number">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" id="department" name="department">
                            <option value="">Select Department</option>
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                            <option value="CE">CE</option>
                            <option value="AIML">AIML</option>
                            <option value="EC">EC</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester">
                            <option value="">Select Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                    </div>

                </div>

                <div class="form-actions">
                    <button class="btn btn-primary btn-block" type="submit" name="register">Register</button>
                </div>

            </form>

            <p class="form-footer">Already registered? <a href="login.php">Login here</a></p>
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
