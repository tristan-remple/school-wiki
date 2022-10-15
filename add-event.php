<?php

include("db.php");

date_default_timezone_set('America/Halifax');

$today = date('Y-m-d h:i:u', strtotime("today"));

$qs = mysqli_query($db, "SELECT `s_tag` FROM `semesters` WHERE `s_start` < '$today'");
$rs = mysqli_fetch_array($qs);

$semester = $rs['s_tag'];

$qc = mysqli_query($db, "SELECT * FROM `class_list` WHERE `semester` = '$semester'");

include("header.php");

?>

  <div class="text-box">
    <div class="padded">
      
      <?php if ($_POST == NULL) { ?>
      
      <form class="formbox" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      Here, you can enter the details for a new event.
      <br>
      <br>
      <label for="title">What is the event's title?</label>
      <input type="text" class="side-link padded" name="title" id="title">
      <br>
      <label for="type">What is the event type?</label>
      <div class="custom-select">
        <select name="type">
          <option value="0">Select:</option>
          <option value="class">Class</option>
          <option value="study">Study</option>
          <option value="homework">Homework</option>
          <option value="meeting">Meeting</option>
          <option value="other">Other</option>
        </select>
      </div>
      <br>
      <label for="class">What course is this event for, if applicable?</label>
      <div class="custom-select">
        <select name="class">
          <option value="0">Select:</option>
          <?php
          
          while ($rc = mysqli_fetch_array($qc)) {
            echo '<option value="', $rc['tag'], '">', $rc['title'], '</option>';
          }
          
          ?>
          <option value="other">Other</option>
        </select>
      </div>
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
      <label for="start">What time does the event start?</label>
      <input class="side-link padded" type="datetime-local" name="start">
      <br>
      <label for="end">What time does the event end?</label>
      <input class="side-link padded" type="datetime-local" name="end">
      <br>
      <label for="assoc_events">If there are any associated events, enter their Event Codes here, comma-separated.</label>
      <input type="text" name="assoc_events" class="side-link padded">
      <br>
      <label for="assoc_notes">If there are any associated topics, please enter their ID tags here, comma-separated.</label>
      <input type="text" class="side-link padded" name="assoc_notes">
      <br>
      <input class="side-link padded" type="submit" name="submit" value="Submit">
      </form>
      
      <?php } else {
        $title = $_POST['title'];
        $type = $_POST['type'];
        $class= $_POST['class'];
        $status = $_POST['status'];
        $content = $_POST['content'];
        $details = $_POST['details'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $assoc_events = $_POST['assoc_events'];
        $assoc_notes = $_POST['assoc_notes'];
        
        if (($title == '') || ($type == 0) || ($class == 0)
      }
      ?>
    </div>
  </div>
</body>
</html>