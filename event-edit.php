<?php

include("db.php");

date_default_timezone_set('America/Halifax');

if ((isset($_GET)) && (isset($_GET['id']))) {
  if (preg_match('/[a-z0-9_-]/i', $_GET['id'])) {
    $id = $_GET['id'];
    $q = mysqli_query($db, "SELECT * FROM `sw_events` WHERE `e_code` = '$id'");
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $row = mysqli_fetch_array($q);
      $error = NULL;
    } else {
      $id = NULL;
      $error = 'Event not found.';
    }
  } else {
    $id = NULL;
    $error = 'Invalid URL.';
  }
} elseif (isset($_POST['e_code'])) {
  if (preg_match('/[a-z0-9_-]/i', $_POST['e_code'])) {
    $id = $_POST['e_code'];
    $q = mysqli_query($db, "SELECT * FROM `sw_events` WHERE `e_code` = '$id'");
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $row = mysqli_fetch_array($q);
      $error = NULL;
    } else {
      $id = NULL;
      $error = 'Something went wrong. Please try again.';
    }
  } else {
    $id = NULL;
    $error = 'Something went wrong.';
  }
} else {
  $id = NULL;
  $error = 'Unspecified URL.';
}

include("header.php");

?>

  <div class="text-box">
    <div class="padded">
      
      <?php if ($error !== NULL) {
        echo $error;
      } elseif ($_POST == NULL) {
        
      if ($row['mod_start'] == NULL) {
        $c_start = $row['start'];
      } else {
        $c_start = $row['mod_start'];
      }
      $day = date('Y-m-d', strtotime($c_start));
      $day_start = date('Y-m-d\TH:i', strtotime($day.' 8:00AM'));
      $day_end = date('Y-m-d\TH:i', strtotime($day.' 8:00PM'));
      
      ?>
      
      <form class="formbox" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      Here, you can change the details for an event. You are currently updating <?php echo 'event ', $id, ' with the title ', $row['title'], ' taking place on ',
      date('F jS', strtotime($c_start)), '.'; ?>
      <br>
      <br>
      <label for="status">What is the status of the event?</label>
      <div class="custom-select">
        <select name="status">
          <option value="0">Select:</option>
          <option value="upcoming">Upcoming</option>
          <option value="past">Past</option>
          <option value="modified">Modified</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
      <br>
      <label for="content">Please enter what happened or is expected to happen at this event, as briefly as possible.</label>
      <input type="text" class="side-link padded" name="content" id="content">
      <br>
      <label for="details">Please enter any relevant details. This may be as long as you like.</label>
      <textarea name="details" class="side-link padded"></textarea>
      <br>
      <label for="start">What time did the event start?</label>
      <input class="side-link padded" type="datetime-local" name="start" value="<?php echo date('Y-m-d\Th:i', strtotime($row['start']));
      ?>" min="<?php echo $day_start; ?>" max="<?php echo $day_end; ?>">
      <br>
      <label for="end">What time did the event end?</label>
      <input class="side-link padded" type="datetime-local" name="end" value="<?php echo date('Y-m-d\Th:i', strtotime($row['end']));
      ?>" min="<?php echo $day_start; ?>" max="<?php echo $day_end; ?>">
      <br>
      <label for="assoc_events">If there are any associated events, enter their Event Codes here, comma-separated.</label>
      <input type="text" name="assoc_events" class="side-link padded">
      <br>
      <label for="assoc_notes">If there are any associated topics, please enter their ID tags here, comma-separated.</label>
      <input type="text" class="side-link padded" name="assoc_notes">
      <br>
      <input type="hidden" name="e_code" value="<?php echo $row['e_code']; ?>">
      <input class="side-link padded" type="submit" name="submit" value="Submit">
      </form>
      
      <?php } elseif (isset($_POST)) {
        
        if (($_POST['status'] !== '0') && ($_POST['status'] !== $row['status'])) {
          $stat = $_POST['status'];
          echo 'Updating the event\'s status to ', $stat, '.<br>';
          $q_stat = "UPDATE `commissions`.`sw_events` SET `status` = '".$stat."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_stat)) {
            echo('Error description: ' . $db -> error . '<br>');
          } else {
            echo 'Event status successfully updated to ', $stat, '.<br>';
          }
        }
        
        if (($_POST['content'] !== '') && ($_POST['content'] !== $row['content'])) {
          $cont = $_POST['content'];
          echo 'Updating the event\'s content tag to ', $cont, '.<br>';
          $q_cont = "UPDATE `commissions`.`sw_events` SET `content` = '".$cont."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_cont)) {
            echo('Error description: '.$db->error.'<br>');
          } else {
            echo 'Event content tag successfully updated to ', $cont, '.<br>';
          }
        }
        
        if (($_POST['details'] !== '') && ($_POST['details'] !== $row['details'])) {
          $det = $_POST['details'];
          echo 'Updating the event\'s detailed description to ', $det, '.<br>';
          $q_det = "UPDATE `commissions`.`sw_events` SET `details` = '".$det."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_det)) {
            echo('Error description: '.$db->error.'<br>');
          } else {
            echo 'Event details successfully updated to ', $det, '.<br>';
          }
        }
        
        if (($_POST['start'] !== '') && ($_POST['start'] !== $row['start']) && ($_POST['start'] !== $row['mod_start'])) {
          $start = $_POST['start'];
          echo $start;
          echo 'Updating the event\'s start time to ', $start, '.<br>';
          $q_start = "UPDATE `commissions`.`sw_events` SET `mod_start` = '".$start."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_start)) {
            echo('Error description: '.$db->error.'<br>');
          } else {
            echo 'Event start time successfully updated to ', $start, '.<br>';
          }
        }
        
        if (($_POST['end'] !== '') && ($_POST['end'] !== $row['end']) && ($_POST['end'] !== $row['mod_end'])) {
          $end = $_POST['end'];
          echo 'Updating the event\'s end time to ', $end, '.<br>';
          $q_end = "UPDATE `commissions`.`sw_events` SET `mod_end` = '".$end."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_end)) {
            echo('Error description: '.$db->error.'<br>');
          } else {
            echo 'Event end time successfully updated to ', $end, '.<br>';
          }
        }
        
        if (($_POST['assoc_events'] !== '') && ($_POST['assoc_events'] !== $row['assoc_events'])) {
          $assoc_events = $_POST['assoc_events'];
          echo 'Updating the event\'s associated events to ', $assoc_events, '.<br>';
          $q_assoc_events = "UPDATE `commissions`.`sw_events` SET `assoc_events` = '".$assoc_events."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_assoc_events)) {
            echo('Error description: '.$db->error.'<br>');
          } else {
            echo 'Event\'s related events successfully updated to ', $assoc_events, '.<br>';
          }
        }
        
        if (($_POST['assoc_notes'] !== '') && ($_POST['assoc_notes'] !== $row['assoc_notes'])) {
          $assoc_notes = $_POST['assoc_notes'];
          echo 'Updating the event\'s related topics to ', $assoc_notes, '.<br>';
          $q_assoc_notes = "UPDATE `commissions`.`sw_events` SET `assoc_notes` = '".$assoc_notes."' WHERE `e_code` = '".$id."'";
          if (!$db -> query($q_assoc_notes)) {
            echo('Error description: '.$db->error.'<br>');
          } else {
            echo 'Event related topics successfully updated to ', $assoc_notes, '.<br>';
          }
        }
        
      }
      ?>
      
    </div>
  </div>
  
  </body>
  </html>