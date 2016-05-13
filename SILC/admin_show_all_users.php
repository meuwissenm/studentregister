<?php
include_once('functions.php');
session_start();
//$course=$_POST['list'];
do_html_header("Administration");
check_admin_user();
echo '<p><b><font size="4">Hello '.$_SESSION['admin_user'].'</font></b></p>';
show_nav_menu();
show_admin_menu();
?>
<?php
//echo '<b>All Users</b><br><br>';

show_users();

do_html_footer();

?>