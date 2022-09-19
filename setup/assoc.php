<?php

include("../db.php");

include("../header.php");
  
?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to correlate topics.<br><br>
        <?php
        
        $q = mysqli_query($db, "SELECT * FROM `topics`");
        while ($row = mysqli_fetch_array($q)) {
            $rel_array = explode(', ', $row['related']);
            foreach ($rel_array as $item) {
                $qi = mysqli_query($db, "SELECT `related`, `title` FROM `topics` WHERE `tag` = '$item'");
                $i_row = mysqli_fetch_array($qi);
                if (!str_contains(($i_row['related']), $row['tag'])) {
                    echo 'I want to add ', $row['tag'], ' to the related topics of ', $i_row['title'], '<br>';
                    
                    $curr_rel = $i_row['related'];
                    $rel = $curr_rel.', '.$row['tag'];
                    echo 'I want to set ', $rel, ' as the related topics of ', $item, '<br>';
                    
                    $ins = mysqli_query($db, "UPDATE `commissions`.`topics` SET `related` = '$rel' WHERE `tag` = '$item'");
                    if (!$db -> query($ins)) {
                        echo("Error description: " . $db -> error);
                    } else {
                        echo "The Topics table was successfully updated.<br><br>";
                    }
                }
            }
        }
        
        /*  */
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>