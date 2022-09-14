<?php

include("db.php");

date_default_timezone_set('America/Halifax');

$course_code = $_POST['class'];
$first = new DateTimeImmutable($_POST['first']);

if ($_POST['sessions'] >= 2) {
  $second = new DateTimeImmutable($_POST['second']);
} else {
  $second = NULL;
}

if ($_POST['sessions'] == 3) {
  $third = new DateTimeImmutable($_POST['third']);
} else {
  $third = NULL;
}

$length = "2 hours";

$q = mysqli_query($db, "SELECT * from `class_list` WHERE `class_code` = '$course_code'");
$row = mysqli_fetch_array($q);

$term = $row['semester'];

$qt = mysqli_query($db, "SELECT * FROM `semesters` WHERE `s_tag` = '$term'");
$qr = mysqli_fetch_array($qt);

$i = 1;
$class = $row['tag'];

$e_code1 = 'c'.$i.'_'.$row['tag'];
$title = $row['title'];
$type = 'class';
$start1 = date_format($first, 'Y-m-d H:i:s');
$end1 = date('Y-m-d H:i:s', strtotime($start1.' + '.$length));
if ($start1 < date('Y-m-d H:i:s', strtotime('now'))) {
  $status1 = 'past';
} else {
  $status1 = 'upcoming';
}
$new_event = "INSERT INTO `sw_events` (e_code, title, type, start, end, class, status)
  VALUES ('$e_code1', '$title', '$type', '$start1', '$end1', '$class', '$status1')";
if (isset($second)) {
  $i++;
  $e_code2 = 'c'.$i.'_'.$row['tag'];
  $start2 = date_format($second, 'Y-m-d H:i:s');
  $end2 = date('Y-m-d H:i:s', strtotime($start2.' + '.$length));
  if ($start2 < date('Y-m-d H:i:s', strtotime('now'))) {
    $status2 = 'past';
  } else {
    $status2 = 'upcoming';
  }
  $new_event = $new_event." , ('$e_code2', '$title', '$type', '$start2', '$end2', '$class', '$status2')";
}
if (isset($third)) {
  $i++;
  $e_code3 = 'c'.$i.'_'.$row['tag'];
  $start3 = date_format($third, 'Y-m-d H:i:s');
  $end3 = date('Y-m-d H:i:s', strtotime($start3.' + '.$length));
  if ($start3 < date('Y-m-d H:i:s', strtotime('now'))) {
    $status3 = 'past';
  } else {
    $status3 = 'upcoming';
  }
  $new_event = $new_event." , ('$e_code3', '$title', '$type', '$start3', '$end3', '$class', '$status3')";
}

include("header.php");

?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to populate the Semesters table.<br><br>
        <?php
        
        if (!$db -> query($new_event)) {
            echo("Error description: " . $db -> error . "<br>");
          } else {
              echo "Event successfully added: ", $e_code1;
              if (isset($e_code2)) { echo ", ", $e_code2; }
              if (isset($e_code3)) { echo ", ", $e_code3; }
              echo "<br>";
          }
        
do {
$i++;

$e_code1 = 'c'.$i.'_'.$row['tag'];


$start1 = date('Y-m-d H:i:s', strtotime($start1.' + 7 days'));
$end1 = date('Y-m-d H:i:s', strtotime($start1.' + '.$length));
if ($start1 < date('Y-m-d H:i:s', strtotime('now'))) {
  $status1 = 'past';
} else {
  $status1 = 'upcoming';
}
$new_event = "INSERT INTO `sw_events` (e_code, title, type, start, end, class, status)
  VALUES ('$e_code1', '$title', '$type', '$start1', '$end1', '$class', '$status1')";
  if ($start1 > $qr['s_end']) {
    break;
  } else {
    if (!$db -> query($new_event)) {
      echo("Error description: " . $db -> error . "<br>");
    } else {
      echo "Event successfully added: ", $e_code1, "<br>";
    }
  }
  
if (isset($second)) {
  $i++;
  $e_code2 = 'c'.$i.'_'.$row['tag'];
  $start2 = date('Y-m-d H:i:s', strtotime($start2.' + 7 days'));
  $end2 = date('Y-m-d H:i:s', strtotime($start2.' + '.$length));
  if ($start2 < date('Y-m-d H:i:s', strtotime('now'))) {
    $status2 = 'past';
  } else {
    $status2 = 'upcoming';
  }
  $new_event = "INSERT INTO `sw_events` (e_code, title, type, start, end, class, status)
  VALUES ('$e_code2', '$title', '$type', '$start2', '$end2', '$class', '$status2')";
  if ($start2 > $qr['s_end']) {
    break;
  } else {
    if (!$db -> query($new_event)) {
      echo("Error description: " . $db -> error . "<br>");
    } else {
      echo "Event successfully added: ", $e_code2, "<br>";
    }
  }
}
if (isset($third)) {
  $i++;
  $e_code3 = 'c'.$i.'_'.$row['tag'];
  $start3 = date('Y-m-d H:i:s', strtotime($start3.' + 7 days'));
  $end3 = date('Y-m-d H:i:s', strtotime($start3.' + '.$length));
  if ($start3 < date('Y-m-d H:i:s', strtotime('now'))) {
    $status3 = 'past';
  } else {
    $status3 = 'upcoming';
  }
  $new_event = "INSERT INTO `sw_events` (e_code, title, type, start, end, class, status)
  VALUES ('$e_code3', '$title', '$type', '$start3', '$end3', '$class', '$status3')";
  if ($start3 > $qr['s_end']) {
    break;
  } else {
    if (!$db -> query($new_event)) {
      echo("Error description: " . $db -> error . "<br>");
    } else {
      echo "Event successfully added: ", $e_code3, "<br>";
    }
  }
}

} while ($start1 < $qr['s_end']);
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>