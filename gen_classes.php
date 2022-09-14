<?php

$server = "localhost";
$user = "root";
$pass = NULL;
$dbase = "commissions";

$db = new mysqli($server, $user, $pass, $dbase);

unset($server);
unset($user);
unset($pass);
unset($dbase);

if ($db -> connect_errno) {
  echo "Failed to connect to MySQL: " . $db -> connect_error;
  exit();
}

$class = "CREATE TABLE `commissions`.`class_list` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `class_code` VARCHAR(255) NOT NULL UNIQUE , CONSTRAINT chk_class_code CHECK (REGEXP_LIKE (`class_code`, '^[A-Za-z0-9_-]+$')) ,
  `title` VARCHAR(255) NOT NULL ,
  `tag` VARCHAR(255) NOT NULL UNIQUE , CONSTRAINT chk_tag CHECK (REGEXP_LIKE (`tag`, '^[a-z]+$')) ,
  `light` VARCHAR(6) NOT NULL , CONSTRAINT chk_light CHECK (REGEXP_LIKE (`light`, '^[A-Z0-9]{6}$')) ,
  `medium` VARCHAR(6) NOT NULL , CONSTRAINT chk_medium CHECK (REGEXP_LIKE (`medium`, '^[A-Z0-9]{6}$')) ,
  `dark` VARCHAR(6) NOT NULL , CONSTRAINT chk_dark CHECK (REGEXP_LIKE (`dark`, '^[A-Z0-9]{6}$')) ,
  PRIMARY KEY (`id`) )
  ENGINE = InnoDB";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap">

<link rel="stylesheet" type="text/css" href="css/dark-mode.css" media="screen and (min-width: 1000px)">
<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width: 999px)">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<title>Knowledge Base</title>

</head>
<body>
<div class="verti">
    
    <div class="header">
        <div class="title">Knowledge Base</div>
        <div class="link-row">
            <a class="top-link" href="info.php?id=orientation">Orientation</a>
            <a class="top-link" href="info.php?id=data">Data Fundamentals</a>
            <a class="top-link" href="info.php?id=logic">Logic & Programming</a>
            <a class="top-link" href="info.php?id=network">Networking & Security</a>
            <a class="top-link" href="info.php?id=prof">Professional Practices</a>
            <a class="top-link" href="info.php?id=webdev">Web Development</a>
            <a class="top-link" href="info.php?id=windows">Windows Administration</a>
        </div>
    </div>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to generate the Classes table.<br><br>
        <?php
        
        if (!$db -> query($class)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Classes table was successfully generated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>