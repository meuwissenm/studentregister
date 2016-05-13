<?php
include_once('functions.php');
session_start();
$drops=$_POST['del_me'];
$user = $_SESSION['valid_user'];
do_html_header("Drop Course");
check_user();
show_nav_menu();
show_user_page();
if (!filled_out($_POST)) {
  echo '<p>You have not chosen a course to drop.<br/>
  	Please try again.</p>';
  //show_user_page();
  do_html_footer();
  exit;
 }else{
 	if(count($drops)>0){
 	  foreach($drops as $course){
 	    if(drop_course($user, $course)){
 	    header('Location:user_page.php');
 	      //show_user_page();
 	      echo '<br>';
 	      //echo '<hr>';
 	      //echo $course.' has been dropped.<br />';
 	    }else{
 	      echo 'Could not drop '.$course.'.<br />';
 	    }
 	  }
 	}else {
 	  echo 'No courses selected';
 	 }
 }

 if ($courses = get_student_courses($user)){
 	display_user_courses($courses);
 }
 header('Location:user_page.php');

 do_html_footer();

?>

