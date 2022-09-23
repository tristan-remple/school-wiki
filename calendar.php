<?php

include("db.php");

date_default_timezone_set('America/Halifax');

function hours_tofloat($val){
    if (empty($val)) {
      return 0;
    }
    $parts = explode(':', $val);
    return $parts[0] + floor(($parts[1]/60)*100) / 100;
}

/* correct date format for the id = 22-09-19 */

if ((isset($_GET)) && (isset($_GET['id']))) {
  if (preg_match('/[^0-9-]/i', $_GET['id'])) {
    $error = 'url';
  } else {
    $id = $_GET['id'];
    $curr_week = date('Y-m-d h:i', strtotime($id));
    $week_end = date('Y-m-d h:i', strtotime($curr_week."+ 7 days"));
    $error = NULL;
  }
} else {
    $curr_week = date('Y-m-d h:i', strtotime('last monday'));
    $week_end = date('Y-m-d h:i', strtotime($curr_week."+ 7 days"));
    $error = NULL;
}

$last_week = date('y-m-d', strtotime($curr_week."- 7 days"));
$this_week = date('y-m-d', strtotime($curr_week));
$next_week = date('y-m-d', strtotime($curr_week."+ 7 days"));

$w_start = date('Y-m-d h:i', strtotime($curr_week.'- 5 hours'));
$w_end = date('Y-m-d h:i', strtotime($week_end.'- 15 hours'));

if ((isset($_GET)) && (isset($_GET['view']))) {
  if (preg_match('/[^a-z-]/i', $_GET['view'])) {
    $error = 'url';
    $view = NULL;
  } else {
    $view = $_GET['view'];
  }
} else {
  $view = NULL;
}

if ($view == 'class') {
  $q = mysqli_query($db, "SELECT * FROM `sw_events` WHERE `start` > '$w_start' AND `start` < '$w_end' AND `type` = 'class'");
} elseif ($view == 'deadline') {
  $q = mysqli_query($db, "SELECT * FROM `sw_events` WHERE `start` > '$w_start' AND `start` < '$w_end' AND `type` = 'deadline'");
} else {
  $q = mysqli_query($db, "SELECT * FROM `sw_events` WHERE `start` > '$w_start' AND `start` < '$w_end' AND `type` != 'deadline'");
}
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $error = NULL;
    } else {
      $error = 'no events';
    }
    
    $events = [];
    
    foreach ($q as $row) {
      $events += [date('Y-m-d h:i', strtotime($row['start'])) => $row];
    }

include("header.php");

if ($error !== NULL) {
  ?>
  
  <div class="text-box">
    <div class="padded">
      <?php
      if ($error == 'no events') {
        echo "There are no events matching your criteria.";
      } else {
        echo "Unable to parse query string.";
      }
      ?>
      <a href="calendar.php" class="side-link"><div class="padded">Main Calendar</div></a>
    </div>
  </div>
  
  <?php
  
} else {

?>
    
    <div class="lightbox-bg hidden">
      <div class="lightbox text-box c_webdev">
        <div class="padded" id="lb-content">
          Meep
        </div>
        <div class="flex-padded">
          <div class="row-box end-btns">
            <a class="side-link" href="info.php?id=webdev" id="info"><div class="padded">View Notes</div></a>
            <a class="side-link" href="add-notes.php" id="add-notes"><div class="padded">Upload Notes</div></a>
            <a class="side-link" href="add-task.php" id="add-task"><div class="padded">Add Task</div></a>
            <a class="side-link" href="event-edit.php" id="event-edit"><div class="padded">Edit Event</div></a>
            <div class="side-link" id="close"><div class="padded">Close</div></div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row-box">
        
        <div class="left-col">
            <div class="text-box">
                <div class="padded">
                    <div class="heading">Controls and Filters</div>
                    <br>
                    <a href="tasks.php" class="side-link"><div class="padded">View Tasks</div></a>
                    <a href="add-task.php" class="side-link"><div class="padded">Add Task</div></a>
                    <a href="add-event.php" class="side-link"><div class="padded">Add Event</div></a>
                    <br><br>
                    <a href="calendar.php?view=class&id=<?php echo $this_week; ?>" class="side-link"><div class="padded">View Classes Only</div></a>
                    <a href="calendar.php?view=deadline&id=<?php echo $this_week; ?>" class="side-link"><div class="padded">View Deadlines</div></a>
                </div>
            </div>
        </div>
        
        <table class="text-box calendar">
          <tr class="cal-head">
            <td class="time"></td>
            <td class="arrow"><a href="calendar.php?id=<?php echo $last_week; ?>"><<</a></td>
            <td colspan="5" class="cal-title title">Week of <?php echo date('F jS', strtotime($curr_week)); ?></td>
            <td class="arrow"><a href="calendar.php?id=<?php echo $next_week; ?>">>></a></td>
          </tr>
          <tr class="weekdays">
            <td>Time</td>
            <td><?php echo date('l', strtotime($curr_week)), '</td>
            <td>', date('l', strtotime($curr_week.'+ 1 day')), '</td>
            <td>', date('l', strtotime($curr_week.'+ 2 days')), '</td>
            <td>', date('l', strtotime($curr_week.'+ 3 days')), '</td>
            <td>', date('l', strtotime($curr_week.'+ 4 days')), '</td>
            <td>', date('l', strtotime($curr_week.'+ 5 days')), '</td>
            <td>', date('l', strtotime($curr_week.'+ 6 days')), '</td>'; ?>
          </tr>
          <tr>
          
          <?php
          
          $day_end = strtotime($curr_week.'+ 8 hours');
          $n_time = strtotime($curr_week.'- 4 hours');
          $d_time = date('g:i', strtotime($n_time));
          $day = 0;
          $e = FALSE;
          $holiq = mysqli_query($db, "SELECT * FROM `holidays` WHERE `start` > '$w_start' AND `start` < '$w_end'");
          if (($holiq !== FALSE) && (mysqli_num_rows($holiq) !== 0)) {
            while ($h = mysqli_fetch_array($holiq)) {
              if (!isset($holiday)) {
                $holiday = date('Y-m-d', strtotime($h['start']));
                $hol = '<td rowspan="24" id="holiday" class="event">
                <div class="e_title">'.$h['title'].'</div>
                </td>';
              } else {
                $holi_arr = array($holiday => $hol);
                $holiday2 = date('Y-m-d', strtotime($h['start']));
                $hol2 = '<td rowspan="24" id="holiday" class="event">
                <div class="e_title">'.$h['title'].'</div>
                </td>';
                $holi_arr += [$holiday2 => $hol2];
              }
            }
          } else {
            $holiday = FALSE;
          }
          
          do {
            echo '<td class="weekdays">', $d_time, '</td>';
            do {
              $slot = date('Y-m-d h:i', strtotime('+'.$day.' days', $n_time));
              $day_array = explode(' ', $slot);
              $d_only = $day_array[0];
              
              if (($d_only == $holiday) && ($d_time == '8:00')) {
                echo $hol;
                $e = TRUE;
              } elseif ((isset($holi_arr)) && ($d_time == '8:00')) {
                foreach ($holi_arr as $holidate => $holibox) {
                  if ($d_only == $holidate) {
                    echo $holibox;
                    $e = TRUE;
                  }
                }
              }
              
              foreach ($events as $key => $value) {
                if ($key == $slot) {
                  $start = $value['start'];
                  
                  $ddd = date('Y-m-d', strtotime($start));
                  
                  if (((!isset($holi_arr)) && ($ddd !== $holiday)) || ((isset($holi_arr)) && (!array_key_exists($ddd, $holi_arr)))) {
                    
                    if (isset($value['end'])) {
                      $end = $value['end'];
                    } else {
                      $end = $start + 1800;
                    }
                    $d_start = date('g:i A', strtotime($start));
                    $d_end = date('g:i A', strtotime($end));
                    
                    $n_start = strtotime($start);
                    $n_end = strtotime($end);
                    $dif = $n_end - $n_start;
                    $span = $dif / 1800;
                    
                    $letter = substr($value['type'], 0, 1);
                    
                    echo '<td id="', $value['e_code'], '" rowspan="', $span, '" class="event ', $letter, '_', $value['class'], '">';
                    echo '<div class="e_title">', $value['title'], '</div>';
                    echo '<div class=e_desc">', $d_start, ' - ', $d_end, '<br>';
                    echo '#', $value['type'], '<br>';
                    if (isset($value['content'])) {
                      echo '*', $value['content'], '<br>';
                    }
                    
                    echo '<div class="hidden" id="', $value['e_code'], '_an">', $value['details'], '</div>';
                    echo '<div class="hidden" id="', $value['e_code'], '_date">', date('F jS, Y', strtotime($start)), '</div>
                    </div>';
                    
                  }
                  
                  $e = TRUE;
                }
              }
              if (($e == FALSE) && ($d_only !== $holiday)) {
                echo '<td id="', $slot, '"></td>';
              }
              
              $e = FALSE;
              $day++;
              if ($day > 6) {
                echo '</tr><tr>';
                $day = 0;
                break;
              }
            } while ($day < 7);
            
            
            $n_time = strtotime('+30 minutes', $n_time);
            $d_time = date('g:i', $n_time);
          } while ($n_time < $day_end); 

          
          ?>
          </tr>
          <!--<tr class="m_week">
            <td class="m_day"></td>
            <td class="m_day"></td>
            <td class="m_day"></td>
            <td class="m_day">
              <div class="m_number">1</div>
            </td>
            <td class="m_day">
              <div class="m_number">2</div>
            </td>
            <td class="m_day">
              <div class="m_number">3</div>
            </td>
            <td class="m_day">
              <div class="m_number">4</div>
            </td>
          </tr>-->
        </table>
        
    </div>
    
    <?php } ?>
    
    </div>
    </body>
    </html>
    