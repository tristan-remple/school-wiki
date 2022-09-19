<?php

include("../db.php");

$class = "CREATE TABLE `commissions`.`class_list` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `class_code` VARCHAR(255) NOT NULL UNIQUE , CONSTRAINT chk_class_code CHECK (REGEXP_LIKE (`class_code`, '^[A-Za-z0-9_-]+$')) ,
  `title` VARCHAR(255) NOT NULL ,
  `tag` VARCHAR(255) NOT NULL UNIQUE , CONSTRAINT chk_tag CHECK (REGEXP_LIKE (`tag`, '^[a-z]+$')) ,
  `light` VARCHAR(6) NOT NULL , CONSTRAINT chk_light CHECK (REGEXP_LIKE (`light`, '^[A-Z0-9]{6}$')) ,
  `medium` VARCHAR(6) NOT NULL , CONSTRAINT chk_medium CHECK (REGEXP_LIKE (`medium`, '^[A-Z0-9]{6}$')) ,
  `dark` VARCHAR(6) NOT NULL , CONSTRAINT chk_dark CHECK (REGEXP_LIKE (`dark`, '^[A-Z0-9]{6}$')) ,
  PRIMARY KEY (`id`) )
  ENGINE = InnoDB";
  
  include("../header.php");
  
?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to generate the Classes table.<br><br>
        <?php
        
        if (!$db -> query($class)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Classes table was successfully generated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>