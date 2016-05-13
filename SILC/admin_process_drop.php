<?php
include_once('functions.php');
session_start();
$drops=$_POST['del_me'];
$user=$_POST['email'];
do_html_header("Drop Course");
check_admin_user();
show_nav_menu();
show_admin_menu();
if (!filled_out($_POST)) {
  echo '<p>You have not chosen a course to drop.<br/>
  	Please try again.</p>';
  //show_admin_menu();
  do_html_footer();
  exit;
 }else{
 	if(count($drops)>0){
 	  foreach($drops as $course){
 	    if(drop_course($user, $course)){
 	      echo '<br>';
 	      //echo '<hr>';
 	      header('Refresh:3; url=admin.php');
 	      echo $course.' has been dropped.<br />';
 	    }else{
 	      echo 'Could not drop '.$course.'.<br />';
 	    }
 	  }
 	}else {
 	  echo 'No courses selected<br>';
 	 }
 }

 do_html_footer();

?>

