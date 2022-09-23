<?php

include("db.php");

function last_monday($date) {
  if (!is_numeric($date)) {
    $date = strtotime($date);
  }
  if (date('w', $date) == 1) {
    $base = $date;
    return date('Y-m-d', $base);
  } else {
    $base = strtotime('last monday', $date);
    return date('Y-m-d', $base);
  }
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
} elseif ((isset($_GET)) && (isset($_GET['n']))) {
  if (preg_match('/[^a-z0-9-_]/i', $_GET['n'])) {
    $error = 'url';
  } else {
    $id = NULL;
    $ne = $_GET['n'];
    $narr = explode('-', $ne, 2);
    $class_tag = $narr[0];
    $qn = mysqli_query($db, "SELECT * FROM `class_list` WHERE `tag` = '$class_tag'");
    if (($qn !== FALSE) && (mysqli_num_rows($qn) !== 0)) {
      $filepath = 'raw/'.$ne.'.txt';
      if (file_exists($filepath)) {
        $n = $ne;
        $error = NULL;
      } else {
        $error = 'We couldn\'t find notes from '.$class_tag.' that day.
        <a class="side-link" href="info.php?id='.$class_tag.'"><div class="padded">View Course</div></a>';
      }
    } else {
      $qe = mysqli_query($db, "SELECT * FROM `sw_events` WHERE `e_code` = '$ne'");
      if (($qe !== FALSE) && (mysqli_num_rows($qe) !== 0)) {
        $erow = mysqli_fetch_array($qe);
        $filename = $erow['class'].'-'.date('Y-m-d', strtotime($erow['start']));
        $filepath = 'raw/'.$filename.'.txt';
        if (file_exists($filepath)) {
          $n = $filename;
          $error = NULL;
        } else {
          $error = 'We couldn\'t find notes from '.$erow['title'].' that day.
          <a class="side-link" href="info.php?id='.$erow['class'].'"><div class="padded">View Course</div></a>';
        }
      } else {
        $error = $class_tag.' isn\'t a subject or event.';
      }
    }
  }
} else {
    $error = 'url';
}

include("header.php");

if ($error == NULL) { ?>
    
    <div class="row-box">
        
        <div class="left-col">
            <?php
            
            if ($id !== NULL) {
            
            if (isset($row['img'])) {
                echo '<img class="left-img" src="img/', $row['img'], '.png">';
            } ?>
            <div class="text-box">
                <div class="padded">
                    <?php
                    
                    $type = $row['type'];
                    
                    $qc = mysqli_query($db, "SELECT `title` FROM `class_list` WHERE `tag` = '$type'");
                    if (($qc !== FALSE) && (mysqli_num_rows($qc) !== 0)) {
                      $cr = mysqli_fetch_array($qc);
                      echo '<a class="side-link" href="info.php?n=', $type, '-', date('Y-m-d', strtotime($row['date'])), '">
                      <div class="padded">', date('M jS, Y', strtotime($row['date'])), '</div></a>';
                      echo '<a href="info.php?id=', $type, '" class="side-link"><div class="padded">', $cr['title'], '</div></a>';
                    } else {
                      echo 'Page type: ', $type, '<br>
                      Notes initiated: ', date('M jS, Y', strtotime($row['date']));
                    }
                    
                    echo '<a class="side-link" href="edit-topic.php?id=', $id, '"><div class="padded">Edit Topic</div></a>';
                    
                    ?>
                </div>
            </div>
            
            <?php
            
            } else {
              
              echo '<div class="text-box">
                <div class="padded">';
                $date = substr($n, -10);
                $course = explode('-', $n);
                $c = $course[0];
                
                $monday = last_monday($date);
                
                echo 'These notes were taken on ', $date, '.<br><br>';
                
                echo '<a class="side-link" href="calendar.php?id=', $monday, '"><div class="padded">View Week</div></a>';
                echo '<a class="side-link" href="edit-notes.php?id=', $n, '"><div class="padded">Edit Notes</div></a>';
                echo '<a class="side-link" href="add-topic.php?n=', $n, '"><div class="padded">Create Topic</div></a>';
                
                $crs_q = mysqli_query($db, "SELECT `title` FROM `class_list` WHERE `tag` = '$c'");
                if (($crs_q !== FALSE) && (mysqli_num_rows($crs_q) !== 0)) {
                  $crs_row = mysqli_fetch_array($crs_q);
                  echo '<a class="side-link" href="info.php?id=', $c, '"><div class="padded">', $crs_row['title'], '</div></a>';
                }
                
                echo '</div></div>';
              
            }
            
            ?>
        </div>
        
        <div class="center-col">
            <div class="text-box">
                <div class="padded">
                  
                  <?php if ($id !== NULL) { ?>
                    <h1><?php echo $row['title']; ?></h1>
                    <?php
                    
                    $filepath = 'txt/'.$row['tag'].'.txt';
                    
                    } else {
                      
                      $filepath = 'raw/'.$n.'.txt';
                      
                    }
                    
                    if (file_exists($filepath)) {
                    
                    $text = fopen($filepath, "r") or die("The specified text could not be found.");
                    while (!feof($text)) {
                        echo fgets($text) . "<br>";
                    }
                    fclose($text);
                    
                    } else {
                      echo 'The specified text could not be found.';
                    }
                    
                    ?>
                </div>
            </div>
        </div>
        
        <?php if ($id !== NULL) { ?>
        
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
        
        <?php
        }
        } elseif ($error == 'url') {
            echo '<div class="text-box"><div class="padded">Incorrect URL</div></div>';
        } else {
          echo '<div class="text-box"><div class="padded">', $error, '</div></div>';
        }
        ?>
        
    </div>
    
</div>