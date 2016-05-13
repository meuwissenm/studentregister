<?php
include_once('functions.php');
session_start();
check_user();

if(isset($_POST['edit'])){
	$name=$_POST['edit'];
	$email=$_POST['email'];
	do_html_header("Edit");
	show_nav_menu();
	//show_user_page();
	echo '<br><br>';
	//admin_add_form($email, read_file('allcourses.txt'));
	display_course_child($name);
	echo '<br><br>';
	$courses = get_child_courses($name);
	echo '<p><font size="4">Current registered course(s) for '."$name".'</font><br>';
	echo '<font size="2">(Registering for two courses in the same category is not allowed.)</font></p>';
	child_courses($courses, $name);
}
if(isset($_POST['delete'])){
	$email=$_POST['delete'];
	do_html_header("Deleted");
	show_nav_menu();
	show_admin_menu();
	delete_user($email);
    generate_regis_users();

}
//echo "hello";
do_html_footer();

?>