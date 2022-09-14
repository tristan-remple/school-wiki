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

date_default_timezone_set('America/Halifax');

$truth_t = "National Truth and Reconciliation Day";
$truth_s1 = new DateTimeImmutable("September 30, 2022 8AM");
$truth_e1 = new DateTimeImmutable("September 30, 2022 8PM");
$truth_s = date_format($truth_s1, 'Y-m-d H:i:s');
$truth_e = date_format($truth_e1, 'Y-m-d H:i:s');

$thank_t = "Thanksgiving Day";
$thank_s1 = new DateTimeImmutable("October 10, 2022 8AM");
$thank_e1 = new DateTimeImmutable("October 10, 2022 8PM");
$thank_s = date_format($thank_s1, 'Y-m-d H:i:s');
$thank_e = date_format($thank_e1, 'Y-m-d H:i:s');

$prof_t = "Study/Professional Development Day";
$prof_s1 = new DateTimeImmutable("November 10, 2022 8AM");
$prof_e1 = new DateTimeImmutable("November 10, 2022 8PM");
$prof_s = date_format($prof_s1, 'Y-m-d H:i:s');
$prof_e = date_format($prof_e1, 'Y-m-d H:i:s');

$remem_t = "Remembrance Day";
$remem_s1 = new DateTimeImmutable("November 11, 2022 8AM");
$remem_e1 = new DateTimeImmutable("November 11, 2022 8PM");
$remem_s = date_format($remem_s1, 'Y-m-d H:i:s');
$remem_e = date_format($remem_e1, 'Y-m-d H:i:s');

$new_hd = "INSERT INTO `holidays` (title, start, end) VALUES
('$truth_t', '$truth_s', '$truth_e'),
('$thank_t', '$thank_s', '$thank_e'),
('$prof_t', '$prof_s', '$prof_e'),
('$remem_t', '$remem_s', '$remem_e')";

include("header.php");

?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to populate the Holidays table.<br><br>
        <?php
        
        if (!$db -> query($new_hd)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Holidays table was successfully populated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>