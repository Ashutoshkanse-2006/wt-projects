-- Student Assignment Submission Portal: tables for a hosted MySQL database.
-- (The original student_portal.sql was empty, so this is rebuilt from the columns the PHP code uses.)

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(100) NOT NULL,
  enrollment_number VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100),
  department VARCHAR(100),
  semester VARCHAR(20),
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS assignments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  enrollment_number VARCHAR(50),
  student_name VARCHAR(100),
  assignment_title VARCHAR(255),
  assignment_file VARCHAR(255),
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Added for Vercel: sessions and submitted files live in the database
CREATE TABLE IF NOT EXISTS php_sessions (
  id VARCHAR(128) NOT NULL PRIMARY KEY,
  data MEDIUMTEXT NOT NULL,
  expires INT NOT NULL
);

CREATE TABLE IF NOT EXISTS uploaded_files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  enrollment_number VARCHAR(50),
  filename VARCHAR(255) NOT NULL,
  mime VARCHAR(100),
  data LONGBLOB NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
