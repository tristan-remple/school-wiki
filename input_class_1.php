<?php

include("db.php");

date_default_timezone_set('America/Halifax');

include("header.php");

?>

  <div class="text-box">
    <div class="padded">
      <form class="formbox" method="post" action="input_class_2.php">
      This is a multi-page input for your classes.<br>
      <br>
      <label for="term">First, select the semester:</label>
      <div class="custom-select">
        <select name="term">
          <option value="0">Select:</option>
          <?php
          
          $qt = mysqli_query($db, "SELECT * FROM `semesters`");
          while ($rt = mysqli_fetch_array($qt)) {
            echo '<option value="', $rt['s_tag'], '">', $rt['season'], ' ', $rt['s_year'], '</option>';
          }
          
          ?>
        </select>
      </div>
      <br>
      <input class="side-link padded" type="submit" name="submit" value="Next...">
      </form>
    </div>
  </div>
  
  </body>
  </html>