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

$update = "ALTER TABLE `class_list` ADD `semester` VARCHAR(255) NOT NULL";

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
        We are attempting to update the Classes table.<br><br>
        <?php
        
        if (!$db -> query($update)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Classes table was successfully updated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>