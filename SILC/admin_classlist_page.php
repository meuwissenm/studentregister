<?php
include_once('functions.php');
session_start();
do_html_header("Admin generate classlist");
if(check_admin_user()){
	show_admin_menu();
?>
<hr>
<?php
	admin_classlist_form(read_file('allcourses.txt'));
}else{
	echo "<p>You are not authorized to enter the administration area.</p>";
}
do_html_footer();

?>