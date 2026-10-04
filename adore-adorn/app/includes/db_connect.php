<?php
// Database connection settings.
// On Vercel these come from Environment Variables (DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_SSL).
// If they are not set, it falls back to the old local XAMPP values, so the project still runs locally.

function env_value($key, $default = null) {
    $v = getenv($key);
    if ($v === false || $v === '') $v = $_ENV[$key] ?? $_SERVER[$key] ?? '';
    return ($v === '' || $v === null) ? $default : $v;
}

function db_connect($defaultName) {
    $host = env_value('DB_HOST', 'localhost');
    $user = env_value('DB_USER', 'root');
    $pass = env_value('DB_PASS', '');
    $name = env_value('DB_NAME', $defaultName);
    $port = (int) env_value('DB_PORT', 3306);
    $ssl  = env_value('DB_SSL', '0');

    $c = mysqli_init();
    mysqli_options($c, MYSQLI_OPT_CONNECT_TIMEOUT, 10);
    $flags = 0;
    if ($ssl !== '0') {
        // Most free cloud MySQL hosts (TiDB Cloud, Aiven, ...) require an encrypted connection.
        $ca = env_value('DB_SSL_CA', null);
        mysqli_ssl_set($c, null, null, $ca, null, null);
        if (!$ca) mysqli_options($c, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
        $flags = MYSQLI_CLIENT_SSL;
    }
    if (!mysqli_real_connect($c, $host, $user, $pass, $name, $port, null, $flags)) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($c, "utf8mb4");
    return $c;
}
