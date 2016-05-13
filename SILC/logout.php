<?php

require_once('functions.php');
session_start();

if(check_admin_user()){
	$old_user = $_SESSION['admin_user'];
	unset($_SESSION['admin_user']);
	session_destroy();
}elseif(check_user()){
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	session_destroy();
}
do_html_header("");


if (!empty($old_user)) {
  echo "<p>Logged out.</p>";
} else {
  echo "<p>You were not logged in.</p>";
  }

 index_footer();

?>