<?php
include_once('functions.php');
session_start();
do_html_header("Student Course Registration");
if(check_user()){
	display_course_register($_SESSION['valid_user']);
?>
<hr>
<?php
	//admin_add_form(read_file('allcourses.txt'));
}else{
	echo "<p>You are not authorized to enter this area.</p>";
}
do_html_footer();

?>