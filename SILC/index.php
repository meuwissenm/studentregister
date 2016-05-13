<?php
require_once('functions.php');
session_start();
do_html_header("Home");
if(check_admin_user()){
echo '<p><b><font size="4">Hello '.$_SESSION['admin_user'].'</font></b></p>';
show_nav_menu();
}
if(check_user()){
$name = get_studentname($_SESSION['valid_user']);
echo '<p><b><font size="4">Hello '.$name.'</font></b></p>';
show_nav_menu();
}

?>
<table style:"display: inline-block;">
<tr valign="top">
	<?php
	if(check_admin_user() or check_user()){
	?>
	<td><?php display_course_form()?></td></tr></table>
	<?php
	}else{
	?>
	<td><a href="register.php">Not register with SILC yet?</a><br><br><?php display_login_form()?></td>
	<td><?php display_course_form()?></td></tr></table>

<?php
}
do_html_footer();
?>