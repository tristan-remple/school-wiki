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

$term = "CREATE TABLE `commissions`.`semesters` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `s_tag` VARCHAR(255) NOT NULL ,
  `s_year` INT(11) NOT NULL ,
  `s_start` TIMESTAMP(6) NOT NULL ,
  `s_end` TIMESTAMP(6) NOT NULL ,
  PRIMARY KEY (`id`) )
  ENGINE = InnoDB";
  
  include("header.php");
   
?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to generate the Semesters table.<br><br>
        <?php
        
        if (!$db -> query($term)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Semesters table was successfully generated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>