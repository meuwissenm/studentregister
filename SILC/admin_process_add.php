<?php
include_once('functions.php');
session_start();
$email=$_POST['email'];
$course=$_POST['add'];
do_html_header("Adding course");
check_admin_user();
show_nav_menu();
show_admin_menu();

$stuname = get_studentname($email);
if(add_course($course,$stuname,$email)){
echo "Course was added successfully for ".$email;
header('Refresh:1; url=admin.php');
}
do_html_footer();

?>