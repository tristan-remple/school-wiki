<?php

include("db.php");

$event = "CREATE TABLE `commissions`.`sw_events` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `e_code` VARCHAR(255) NOT NULL UNIQUE , CONSTRAINT chk_e_code CHECK (REGEXP_LIKE (`e_code`, '^[A-Za-z0-9_]+$')) ,
  `title` VARCHAR(255) NOT NULL , CONSTRAINT chk_title CHECK (REGEXP_LIKE (`title`, '^[A-Za-z0-9]+$')) ,
  `type` VARCHAR(255) NOT NULL , CONSTRAINT CHK_type CHECK (`type` IN ('class', 'homework', 'deadline', 'meeting', 'study')) ,
  `start` TIMESTAMP(6) NOT NULL ,
  `end` TIMESTAMP(6) NULL DEFAULT NULL ,
  `class` VARCHAR(255) NOT NULL , CONSTRAINT CHK_class CHECK (`class` IN ('webdev', 'windows', 'data', 'prof', 'logic', 'network', 'addvocacy', 'admin')) ,
  `assoc_notes` VARCHAR(255) NULL DEFAULT NULL ,
  `assoc_events` VARCHAR(255) NULL DEFAULT NULL ,
  `status` VARCHAR(255) NOT NULL DEFAULT 'upcoming', CONSTRAINT CHK_status CHECK (`status` IN ('upcoming', 'past', 'changed', 'cancelled')),
  `details` TEXT(3000) NULL DEFAULT NULL ,
  `mod_start` TIMESTAMP(6) NULL DEFAULT NULL ,
  `mod_end` TIMESTAMP(6) NULL DEFAULT NULL ,
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
        We are attempting to generate the Events table.<br><br>
        <?php
        
        if (!$db -> query($event)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Events table was successfully generated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>