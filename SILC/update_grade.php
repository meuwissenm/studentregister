<?php
include_once('functions.php');
session_start();
$name=$_POST['name'];
$grade=$_POST['grade'];
do_html_header("");
if(check_admin_user()){
update_grade_db($name,$grade);
header('Location: admin.php');
}
?>
<?php


do_html_footer();

?>