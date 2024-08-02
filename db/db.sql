-- Create the database
DROP DATABASE IF EXISTS jbp;
CREATE DATABASE jbp;

-- Use the database
USE jbp;

-- Create the Users table
CREATE TABLE `users` (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    profile_pic VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    usertype ENUM('JobSeeker', 'Employer', 'Admin') NOT NULL,
    cv TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the JobSeekers table
CREATE TABLE `job_seekers` (
    user_id INT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    occupation VARCHAR(50),
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the Employers table
CREATE TABLE `employers` (
    user_id INT PRIMARY KEY,
    org_name VARCHAR(100) UNIQUE NOT NULL,
    creation_date DATE NOT NULL,
    industry VARCHAR(50),
    tag_ids JSON,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the Tags table
CREATE TABLE `tags` (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the JobReq table
CREATE TABLE `job_req` (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(100) NOT NULL,
    job_description TEXT NOT NULL,
    user_id INT NOT NULL,
    responsibility TEXT NOT NULL,
    experience VARCHAR(100),
    benefits TEXT,
    vacancy INT,
    status ENUM('Full-Time', 'Part-Time', 'Contract') NOT NULL,
    job_location VARCHAR(255),
    salary DECIMAL(10, 2),
    gender ENUM('Male', 'Female', 'Other', 'Any'),
    application_deadline DATE,
    published_on DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (user_id) REFERENCES employers(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the Applications table
CREATE TABLE `applications` (
    app_id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    user_id INT NOT NULL,
    date_of_application DATE NOT NULL,
    FOREIGN KEY (job_id) REFERENCES job_req(job_id),
    FOREIGN KEY (user_id) REFERENCES job_seekers(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Insert Statement
INSERT INTO `tags` (tag_name) VALUES
('Technology'),
('Education'),
('Research'),
('Healthcare'),
('Finance'),
('Marketing'),
('Engineering'),
('Human Resources');
