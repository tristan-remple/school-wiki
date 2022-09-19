<?php

include("../db.php");

$holiday = "CREATE TABLE `commissions`.`holidays` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `start` TIMESTAMP(6) NOT NULL ,
  `end` TIMESTAMP(6) NOT NULL ,
  PRIMARY KEY (`id`) )
  ENGINE = InnoDB";

include("../header.php");

?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to generate the Holidays table.<br><br>
        <?php
        
        if (!$db -> query($holiday)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Holidays table was successfully generated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>