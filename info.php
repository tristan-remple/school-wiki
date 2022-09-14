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

if ((isset($_GET)) && (isset($_GET['id']))) {
  if (preg_match('/[^a-z-]/i', $_GET['id'])) {
    $error = 'url';
  } else {
    $id = $_GET['id'];
    $q = mysqli_query($db, "SELECT * FROM `topics` WHERE `tag` = '$id'");
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $row = mysqli_fetch_array($q);
      $error = NULL;
    } else {
        $error = 'url';
    }
  }
} else {
    $error = 'url';
}

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
    
    <?php if ($error == NULL) { ?>
    
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
    
    <div class="row-box">
        
        <div class="left-col">
            <?php if (isset($row['img'])) {
                echo '<img class="left-img" src="img/', $row['img'], '.png">';
            } ?>
            <div class="text-box">
                <div class="padded">
                    Date initiated: <?php echo date('M jS, Y', strtotime($row['date'])); ?><br>
                    Page type: <?php echo $row['type']; ?>
                </div>
            </div>
        </div>
        
        <div class="center-col">
            <div class="text-box">
                <div class="padded">
                    <h1><?php echo $row['title']; ?></h1>
                    <?php
                    
                    $filepath = 'txt/'.$row['tag'].'.txt';
                    
                    $text = fopen($filepath, "r") or die("The specified text could not be found.");
                    while (!feof($text)) {
                        echo fgets($text) . "<br>";
                    }
                    fclose($text);
                    
                    ?>
                </div>
            </div>
        </div>
        
        <div class="right-col">
            
            <?php
            
            $r = $row['related'];
            if (str_contains($r, ', ')) {
                $r_set = explode(', ', $r);
                foreach ($r_set as $key => $value) {
                    $qr = mysqli_query($db, "SELECT * FROM `topics` WHERE `tag` = '$value'");
                    if (($qr !== FALSE) && (mysqli_num_rows($qr) !== 0)) {
                      $rr = mysqli_fetch_array($qr);
                    }
                    echo '<a class="side-link" href="info.php?id=', $value, '"><div class="padded">', $rr['title'], '</div></a>';
                }
            } else {
                $qr = mysqli_query($db, "SELECT * FROM `topics` WHERE `tag` = '$r'");
                if (($qr !== FALSE) && (mysqli_num_rows($qr) !== 0)) {
                    $rr = mysqli_fetch_array($qr);
                }
                echo '<a class="side-link" href="info.php?id=', $r, '"><div class="padded">', $rr['title'], '</div></a>';
            }
            
            ?>
        
        </div>
        
        <?php } else {
            echo '<div class="text-box"><div class="padded">Incorrect URL</div></div>';
        } ?>
        
    </div>
    
</div>