<?php

include("db.php");

date_default_timezone_set('America/Halifax');

$t1_t = "fall-2022";
$t1_s1 = new DateTimeImmutable("September 6, 2022 8AM");
$t1_e1 = new DateTimeImmutable("December 15, 2022 8PM");
$t1_s = date_format($t1_s1, 'Y-m-d H:i:s');
$t1_e = date_format($t1_e1, 'Y-m-d H:i:s');
$t1_y = 1;

$new_hd = "INSERT INTO `semesters` (s_tag, s_year, s_start, s_end) VALUES
('$t1_t', '$t1_y', '$t1_s', '$t1_e')";

include("header.php");

?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to populate the Semesters table.<br><br>
        <?php
        
        if (!$db -> query($new_hd)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Semesters table was successfully populated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>