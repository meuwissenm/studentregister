<?php

// include function files for this application
require_once('functions.php');
session_start();


do_html_header("Administration");
if (check_admin_user()) {
  echo '<p><b><font size="4">Hello '.$_SESSION['admin_user'].'</font></b></p>';
  show_nav_menu();?>

  <?php
  show_admin_menu();
  generate_regis_users();
  show_user_info();
  generate_classlist();
  admin_classlist_form();
} else {
  echo "<p>You are not authorized to enter the administration area.</p>";
  show_nav_menu();
}
do_html_footer();

?>