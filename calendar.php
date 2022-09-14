<?php

include("db.php");

/*
if ((isset($_GET)) && (isset($_GET['id']))) {
  if (preg_match('/[^a-z-]/i', $_GET['id'])) {
    $error = 'url';
  } else {
    $id = $_GET['id'];
    $q = mysqli_query($db, "SELECT * FROM `topics` WHERE `tag` = '$id'");
    if (($q !== FALSE) && (mysqli_num_rows($q) !== 0)) {
      $row = mysqli_fetch_array($q);
      $error = NULL;
    } else {
        $error = 'url';
    }
  }
} else {
    $error = 'url';
}
*/

include("header.php");

?>
    
    <div class="lightbox-bg hidden">
      <div class="lightbox text-box c_webdev">
        <div class="padded" id="lb-content">
          Meep
        </div>
        <div class="flex-padded">
          <div class="row-box end-btns">
            <a class="side-link" href="info.php?id=webdev" id="lb-notes"><div class="padded">Class Notes</div></a>
            <a class="side-link" href="info.php?id=webdev"><div class="padded">Course Overview</div></a>
            <div class="side-link" id="close"><div class="padded">Close</div></div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row-box">
        
        <div class="left-col">
            <div class="text-box">
                <div class="padded">
                    Controls and Filters
                </div>
            </div>
        </div>
        
        <table class="text-box calendar">
          <tr class="cal-head">
            <td class="time"></td>
            <td class="arrow"><a href="calendar.php?m=22-08"><<</a></td>
            <td colspan="5" class="cal-title title">September</td>
            <td class="arrow"><a href="calendar.php?m=22-10">>></a></td>
          </tr>
          <tr class="weekdays">
            <td>Time</td>
            <td>Monday</td>
            <td>Tuesday</td>
            <td>Wednesday</td>
            <td>Thursday</td>
            <td>Friday</td>
            <td>Saturday</td>
            <td>Sunday</td>
          </tr>
          <tr>
            <td class="weekdays">8:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">8:30</td>
            <td rowspan="4" class="event c_webdev" id="c1_webdev">
              <div class="e_title">Website Development</div>
              <div class="e_desc">8:30 - 10:30<br>
              ITC-D327 #class</div>
              <div class="hidden" id="c1_webdev_h">vm</div>
            </td>
            <td rowspan="4" class="event c_data">
              <div class="e_title">Data Fundamentals</div>
              8:30 - 10:30<br>
              ITC-D125 #class
            </td>
            <td rowspan="4" class="event c_network">
              <div class="e_title">Networking & Security</div>
              8:30 - 10:30<br>
              ITC-D327 #class
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">9:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">9:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">10:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">10:30</td>
            <td rowspan="4" class="event c_windows">
              <div class="e_title">Windows Admin</div>
              10:30 - 12:30<br>
              ITC-D225 #class
            </td>
            <td rowspan="4" class="event c_prof">
              <div class="e_title">Prof Practices</div>
              10:30 - 12:30<br>
              ITC-D327 #class
            </td>
            <td rowspan="4" class="event c_logic">
              <div class="e_title">Logic & Programming</div>
              10:30 - 12:30<br>
              ITC-D327 #class
            </td>
            <td rowspan="4" class="event c_data">
              <div class="e_title">Data Fundamentals</div>
              10:30 - 12:30<br>
              ITC-D327 #class
            </td>
            <td rowspan="4" class="event c_logic">
              <div class="e_title">Logic & Programming</div>
              10:30 - 12:30<br>
              ITC-D327 #class
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">11:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">11:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">12:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">12:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td rowspan="4" class="event c_network">
              <div class="e_title">Networking & Security</div>
              12:30 - 2:30<br>
              ITC-D327 #class
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">1:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">1:30</td>
            <td></td>
            <td rowspan="4" class="event c_logic">
              <div class="e_title">Logic & Programming</div>
              1:30 - 3:30<br>
              ITC-D327 #class
            </td>
            <td rowspan="4" class="event c_webdev">
              <div class="e_title">"Website Development</div>
              1:30 - 3:30<br>
              ITC-B150A #class
            </td>
            <td rowspan="4" class="event c_windows">
              <div class="e_title">Windows Admin</div>
              1:30 - 3:30<br>
              ITC-D327 #class
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">2:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">2:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">3:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">3:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">4:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">4:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">5:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">5:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">6:00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="weekdays">6:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
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