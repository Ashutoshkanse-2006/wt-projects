<?php
// Database connection + helpers. Included at the top of every page.
// $conn and the (database-backed) session are created in session.php.
require_once __DIR__ . '/db_connect.php';
if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = db_connect('adore_adorn');
}
require_once __DIR__ . '/session.php';

// $base makes links/images work from both the main folder and the admin folder
$inAdmin = basename(dirname($_SERVER['SCRIPT_NAME'])) == 'admin';
$base = $inAdmin ? '../' : '';

// Safe output (prevents HTML injection)
function e($text) {
    return htmlspecialchars($text ?? '');
}

// Run a query. Example: q("SELECT * FROM users WHERE id=?", "i", [5]);
// SELECT returns a result you can loop over; other queries return false.
function q($sql, $types = "", $params = []) {
    global $conn;
    $st = mysqli_prepare($conn, $sql);
    if ($types != "") {
        mysqli_stmt_bind_param($st, $types, ...$params);
    }
    mysqli_stmt_execute($st);
    return mysqli_stmt_get_result($st);
}

// Get all rows of a SELECT as an array
function rows($result) {
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Get a single row (or null)
function one($sql, $types = "", $params = []) {
    return mysqli_fetch_assoc(q($sql, $types, $params));
}

// Upload a product image. Vercel has no permanent disk, so the image is stored in the database
// (table uploaded_files) and served by file.php. Returns "db:<id>", '' if none chosen,
// or false if the file type is not allowed.
function uploadImage($file) {
    global $conn;
    if (!isset($file) || $file['error'] != 0) return '';
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) return false;
    $mimes = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'webp' => 'image/webp'];
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS uploaded_files (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        mime VARCHAR(100) NOT NULL,
        data LONGBLOB NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $data = file_get_contents($file['tmp_name']);
    q("INSERT INTO uploaded_files (filename, mime, data) VALUES (?,?,?)", "sss", [$file['name'], $mimes[$ext], $data]);
    return "db:" . mysqli_insert_id($conn);
}

// Public URL of a product image. Old images are bundled files; new ones come from the database.
function imgUrl($image) {
    global $base;
    if (strpos($image, 'db:') === 0) return $base . 'file.php?id=' . (int) substr($image, 3);
    return $base . 'uploads/products/' . $image;
}

// Remove an image that was uploaded through the admin panel (bundled images are read-only).
function deleteImage($image) {
    if (strpos($image, 'db:') === 0) {
        q("DELETE FROM uploaded_files WHERE id=?", "i", [(int) substr($image, 3)]);
    }
}
