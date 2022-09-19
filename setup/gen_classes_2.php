<?php

include("../db.php");

$update = "ALTER TABLE `class_list` ADD `semester` VARCHAR(255) NOT NULL";

include("../header.php");

?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to update the Classes table.<br><br>
        <?php
        
        if (!$db -> query($update)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Classes table was successfully updated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>