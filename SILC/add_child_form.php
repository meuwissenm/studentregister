<?php

// include function files for this application
require_once('functions.php');
session_start();


do_html_header("Add child");
if (check_user()) {
  $name = get_studentname($_SESSION['valid_user']);
  echo '<p><b><font size="4">Hello '.$name.'</font></b></p>';
  show_nav_menu();
  //show_user_page();
  //$array = get_student_courses($_SESSION['valid_user']);
  ?>
  <hr>
  <?php
  //echo '<p><font size="4">Current registered course(s)</font></p>';
  add_child($_SESSION['valid_user']);
} else {
  show_nav_menu();
  echo "<p>You are not authorized to enter this area.</p>";
}
do_html_footer();

?>