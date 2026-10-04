<?php
// Vercel has no permanent disk, so submitted files are stored in the database
// (table uploaded_files) instead of being moved into a folder. download.php serves them back.
// Note: Vercel limits a request body to about 4.5 MB, so uploads must be smaller than that.

function save_upload($tmp_name, $file_name, $enrollment_number) {
    global $conn;
    if (!is_uploaded_file($tmp_name)) return false;
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS uploaded_files (
        id INT AUTO_INCREMENT PRIMARY KEY,
        enrollment_number VARCHAR(50),
        filename VARCHAR(255) NOT NULL,
        mime VARCHAR(100),
        data LONGBLOB NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $data = file_get_contents($tmp_name);
    $mime = function_exists('mime_content_type') ? (mime_content_type($tmp_name) ?: 'application/octet-stream') : 'application/octet-stream';
    $st = mysqli_prepare($conn, "INSERT INTO uploaded_files (enrollment_number, filename, mime, data) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($st, "ssss", $enrollment_number, $file_name, $mime, $data);
    return mysqli_stmt_execute($st);
}
