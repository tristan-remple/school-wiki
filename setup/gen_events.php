<?php

include("../db.php");

$event = "CREATE TABLE `commissions`.`sw_events` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `e_code` VARCHAR(255) NOT NULL UNIQUE , CONSTRAINT chk_e_code CHECK (REGEXP_LIKE (`e_code`, '^[A-Za-z0-9_]+$')) ,
  `title` VARCHAR(255) NOT NULL , CONSTRAINT chk_title CHECK (REGEXP_LIKE (`title`, '^[A-Za-z0-9]+$')) ,
  `type` VARCHAR(255) NOT NULL , CONSTRAINT CHK_type CHECK (`type` IN ('class', 'homework', 'deadline', 'meeting', 'study')) ,
  `start` TIMESTAMP(6) NOT NULL ,
  `end` TIMESTAMP(6) NULL DEFAULT NULL ,
  `class` VARCHAR(255) NOT NULL , CONSTRAINT CHK_class CHECK (`class` IN ('webdev', 'windows', 'data', 'prof', 'logic', 'network', 'addvocacy', 'admin')) ,
  `assoc_notes` VARCHAR(255) NULL DEFAULT NULL ,
  `assoc_events` VARCHAR(255) NULL DEFAULT NULL ,
  `status` VARCHAR(255) NOT NULL DEFAULT 'upcoming', CONSTRAINT CHK_status CHECK (`status` IN ('upcoming', 'past', 'changed', 'cancelled')),
  `details` TEXT(3000) NULL DEFAULT NULL ,
  `mod_start` TIMESTAMP(6) NULL DEFAULT NULL ,
  `mod_end` TIMESTAMP(6) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
  ENGINE = InnoDB";
  
  include("../header.php");
  
?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to generate the Events table.<br><br>
        <?php
        
        if (!$db -> query($event)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Events table was successfully generated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>