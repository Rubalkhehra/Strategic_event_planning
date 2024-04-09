CREATE TABLE IF NOT EXISTS Users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    usertype ENUM('client', 'contributor') NOT NULL
   
);

CREATE TABLE IF NOT EXISTS clientProfile (
    cpid INT AUTO_INCREMENT PRIMARY KEY,
    uid INT UNIQUE,
    FOREIGN KEY (uid) REFERENCES Users(uid)
    
);

CREATE TABLE IF NOT EXISTS contributorProfile (
    conid INT AUTO_INCREMENT PRIMARY KEY,
    uid INT UNIQUE,
    FOREIGN KEY (uid) REFERENCES Users(uid)
   
);

CREATE TABLE IF NOT EXISTS planner (
    pid INT AUTO_INCREMENT PRIMARY KEY,
    function_name VARCHAR(255),
    services TEXT
   
);

CREATE TABLE IF NOT EXISTS contributorservices (
    csid INT AUTO_INCREMENT PRIMARY KEY,
    conid INT,
    function_name VARCHAR(255),
    services TEXT,
    FOREIGN KEY (conid) REFERENCES contributorProfile(conid)
);

CREATE TABLE IF NOT EXISTS contributorcities (
    ccid INT AUTO_INCREMENT PRIMARY KEY,
    conid INT,
    city VARCHAR(255),
    state VARCHAR(255),
    FOREIGN KEY (conid) REFERENCES contributorProfile(conid)
);
