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

$s = 'fall-2022';

$new_class = "INSERT INTO `class_list` (class_code, title, tag, light, medium, dark, semester) VALUES
('WEBD1000', 'Website Development', 'webdev', '512A35', '8A3B52', 'DF3E5C', '$s'),
('OSYS1200', 'Intro to Windows Administration', 'windows', '343E5D', '395784', '5187DA', '$s'),
('DBAS1007', 'Data Fundamentals', 'data', '284136', '358B53', '45BA6E', '$s'),
('COMM1700', 'Professional Practices for IT 1', 'prof', '213D42', '2A7777', '2AAF9E', '$s'),
('PROG1700', 'Logic and Programming 1', 'logic', '49325C', '6D4684', 'AD51DA', '$s'),
('NETW1700', 'Intro to Networking and Security', 'network', '522A4B', '88346F', 'E33CAC', '$s')";

include("header.php");

?>
    
    <div class="text-box">
      <div class="padded">
        We are attempting to populate the Classes table.<br><br>
        <?php
        
        if (!$db -> query($new_class)) {
          echo("Error description: " . $db -> error);
        } else {
            echo "The Classes table was successfully populated.";
        }
        
        ?>
      </div>
    </div>
    
</div>
</body>
</html>