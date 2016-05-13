<?php
include_once('functions.php');
session_start();
check_admin_user();

if(isset($_POST['edit'])){
	$name=$_POST['edit'];
	$email=get_studentemail($name);
	do_html_header("Edit");
	show_nav_menu();
	//show_admin_menu();
	echo '<br><br>';
	//admin_add_form($email, read_file('allcourses.txt'));
	display_course_child($name);
	echo '<br><br>';
	$courses = get_child_courses($name);
	echo '<p><font size="4">Current registered course(s) for '."$name".'</font><br>';
	echo '<font size="2">(Registering for two courses in the same category is not allowed.)</font></p>';
	admin_user_courses($courses, $email);
}
if(isset($_POST['delete'])){
	$name=$_POST['delete'];
	do_html_header("Deleted");
	show_nav_menu();
	//show_admin_menu();
	delete_user($name);
    //generate_regis_users();
    header('Location: admin.php');

}
//echo "hello";
do_html_footer();

?>