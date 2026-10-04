<?php
// Lets a logged-in student download a file they submitted: /download.php?name=report.pdf
require_once __DIR__ . '/includes/session.php';

if (!isset($_SESSION['student_name'])) {
    header("Location: login.php");
    exit();
}

$name = $_GET['name'] ?? '';
$enrollment = $_SESSION['enrollment_number'];

$st = mysqli_prepare($conn, "SELECT filename, mime, data FROM uploaded_files WHERE filename=? AND enrollment_number=? ORDER BY id DESC LIMIT 1");
mysqli_stmt_bind_param($st, "ss", $name, $enrollment);
mysqli_stmt_execute($st);
$f = mysqli_fetch_assoc(mysqli_stmt_get_result($st));

if (!$f) {
    http_response_code(404);
    echo "File not found.";
    exit();
}

header("Content-Type: " . ($f['mime'] ?: 'application/octet-stream'));
header('Content-Disposition: inline; filename="' . str_replace('"', '', $f['filename']) . '"');
echo $f['data'];
