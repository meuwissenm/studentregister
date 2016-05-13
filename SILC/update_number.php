<?php
include_once('functions.php');
session_start();
$name=$_POST['name'];
$pn=$_POST['number'];
do_html_header("");
if(check_admin_user()){
update_number_db($name,$pn);
header('Location: admin.php');
}
?>
<?php


do_html_footer();

?>