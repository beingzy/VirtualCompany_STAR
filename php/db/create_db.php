<?php
require "db_connection.php";

$sql_query_file = "
        CREATE TABLE IF NOT EXISTS file(
            fileid INT NOT NULL AUTO_INCREMENT,            
            userid INT NOT NULL,
            teamid INT,
            created DATETIME NOT NULL,
            name VARCHAR(128),
            mime VARCHAR(16),
            size BIGINT,
            CONTENT LONGBLOB,
            PRIMARY KEY (fileid)
            )  ENGINE=InnoDB";


$sql_query_project = "
        CREATE TABLE IF NOT EXISTS project(
            projectid INT NOT NULL AUTO_INCREMENT,
            userid INT NOT NULL,
            created DATETIME NOT NULL,
            modified DATETIME,
            title VARCHAR(128),
            department VARCHAR(64),
            textbody TEXT NOT NULL,
            deadline DATETIME,
            PRIMARY KEY (projectid),
            UNIQUE (title)
            )   ENGINE=InnoDB";

$sql_query_project_file = "
        CREATE TABLE IF NOT EXISTS project_file(
            fileid INT NOT NULL AUTO_INCREMENT,            
            userid INT NOT NULL,
            projectid INT NOT NULL,
            created DATETIME NOT NULL,
            name VARCHAR(128),
            mime VARCHAR(16),
            size BIGINT,
            CONTENT LONGBLOB,
            PRIMARY KEY (fileid)
            )  ENGINE=InnoDB";


$sql_query_team = "
        CREATE TABLE IF NOT EXISTS team(
            teamid INT NOT NULL,
            projectid INT NOT NULL,
            userid INT NOT NULL
            ) ENGINE=InnoDB";

$sql_query_team_info = "
        CREATE TABLE IF NOT EXISTS team_info(
            teamid INT NOT NULL,
            grade VARCHAR(10),
            textbody TEXT
        )
        ";

$sql_query_director_feedback = "
        CREATE TABLE IF NOT EXISTS director_feedback(
            id INT NOT NULL AUTO_INCREMENT,
            teamid INT NOT NULL,
            userid INT NOT NULL,
            textbody TEXT,
            datetime DATETIME,
            PRIMARY KEY (id)
            )ENGINE=InnoDB";

$sql_query_consultant_feedback = "
        CREATE TABLE IF NOT EXISTS consultant_feedback(
            id INT NOT NULL AUTO_INCREMENT,
            teamid INT NOT NULL,
            userid INT NOT NULL,
            textbody TEXT,
            datetime DATETIME,
            PRIMARY KEY (id)
            )ENGINE=InnoDB";

$sql_query_team_info = "
            CREATE TABLE IF NOT EXISTS team_info(
            teamid INT NOT NULL,
            feedback LONGTEXT NOT NULL DEFAULT 'No Feedback from the director.',
            comment LONGTEXT NOT NULL DEFAULT 'Not comments from the consultant.',
            grade FLOAT NOT DEFAULT 0.0,
            PRIMARY KEY (teamid)
            ) ENGINE=InnoDB";

$sql_query_user = "
        CREATE TABLE IF NOT EXISTS user(
            userid INT NOT NULL AUTO_INCREMENT,
            username VARCHAR(128) NOT NULL,
            password VARCHAR(256) NOT NULL,
            department VARCHAR(40) NOT NULL,
            role VARCHAR(40) NOT NULL,
            firstname VARCHAR(128),
            lastname VARCHAR(128),
            created DATETIME,
            PRIMARY KEY (userid),
            UNIQUE (username)
        ) ENGINE=InnoDB";

$sql_query_userinfo = "
        CREATE TABLE IF NOT EXISTS userinfo(
            userid INT NOT NULL,
            ucid varchar(12),
            phone TEXT,
            email TEXT,
            age INT,
            gender VARCHAR(16),
            PRIMARY KEY (userid)
            ) ENGINE=InnoDB";

// excute sql query
$result = $db->query($sql_query_file);

if(!$result){
    $msg = "<li>Creating file table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_solution);
if(!$result){
    $msg .= "<li>Creating solution table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_project);
if(!$result){
    $msg .= "<li>Creating project table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_project_file);
if(!$result){
    $msg .= "<li>Creating project_file table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_team);
if(!$result){
    $msg .= "<li>Creating team table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_team_info);
if(!$result){
    $msg .= "<li>Creating team_info table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_director_feedback);
if(!$result){
    $msg .= "<li>Creating director_feedback table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_consultant_feedback);
if(!$result){
    $msg .= "<li>Creating director_feedback table fialed due to :" . $result->error."</li>";
}

$result = $db->query($sql_query_user);
if(!$result){
    $msg .= "<p>Creating user table fialed due to :" . $result->error."</p>";
}

$result = $db->query($sql_query_userinfo);
if(!$result){
    $msg .= "<p>Creating userinfo table fialed due to :" . $result->error."</p>";
}

// present the result
if(empty($msg)){
    $msg = "<p><strong>Congradulation</strong>: Creating database succeeded!</p>";
    header("location: ../../success_page.php?msg={$msg}");
}else{
    $msg = '<ol>'.$msg.'</ol>';
    header("location: ../../error_page.php?msg={$msg}");
}

$result->free();
$db->close();
?>
