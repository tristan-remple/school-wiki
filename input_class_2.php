<?php

include("db.php");

date_default_timezone_set('America/Halifax');

include("header.php");

if ((isset($_POST)) && (isset($_POST['term']))) {
  $t = $_POST['term'];
  
  $qt = mysqli_query($db, "SELECT * FROM `semesters` WHERE `s_tag` = '$t'");
  if ($qt !== NULL) {
    $rt = mysqli_fetch_array($qt);
    if ($rt !== NULL) {
      $error = NULL;
    } else {
      $error = 'Error: incorrect input.<br>
      Please go back to the previous step.<br><br>
      <a class="side-link padded" href="input_class_1.php">Return</a>';
    }
  } else {
    $error = 'Error: incorrect input.<br>
    Please go back to the previous step.<br><br>
    <a class="side-link padded" href="input_class_1.php">Return</a>';
  }
  
} else {
  $t = NULL;
  $error = 'Error: no input.<br>
  Please go back to the previous step.<br><br>
  <a class="side-link padded" href="input_class_1.php">Return</a>';
}

?>

  <div class="text-box">
    <div class="padded">
      
      <?php if ($error == NULL) { ?>
      <form class="formbox" method="post" action="insert_regular.php">
      Please input your first week of classes for one course.<br>
      <br>
      <label for="class">Select the course.</label>
      <div class="custom-select">
        <select name="class">
          <option value="0">Select:</option>
          <?php
          
          $qc = mysqli_query($db, "SELECT * FROM `class_list` WHERE `semester` = '$t'");
          while ($rc = mysqli_fetch_array($qc)) {
            echo '<option value="', $rc['class_code'], '">', $rc['title'], '</option>';
          }
          
          ?>
        </select>
      </div>
      <br>
      <label for="sessions">How many times do you have this class in a week?</label><br>
      <input type="number" name="sessions" value="1" min="1" max="3" class="side-link padded">
      <br>
      <label for="first">Start time of your first class for this course.</label>
      <input class="side-link padded" type="datetime-local" name="first" value="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_start'])); ?>"
      min="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_start'])); ?>" max="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_end'])); ?>">
      <br>
      <label for="second">Start time of your second class for this course, if applicable.</label>
      <input class="side-link padded" type="datetime-local" name="second" value="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_start'])); ?>"
      min="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_start'])); ?>" max="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_end'])); ?>">
      <br>
      <label for="third">Start time of your third class for this course, if applicable.</label>
      <input class="side-link padded" type="datetime-local" name="third" value="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_start'])); ?>"
      min="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_start'])); ?>" max="<?php echo date('Y-m-d\Th:i', strtotime($rt['s_end'])); ?>">
      <br>
      <input class="side-link padded" type="submit" name="submit" value="Submit">
      
      <?php } else {
        echo $error;
      }
      ?>
      
    </div>
  </div>
  
  </body>
  </html>