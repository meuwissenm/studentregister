<?php
include_once('functions.php');
session_start();
$name=$_POST['child'];
$grade=$_POST['grade'];
$email=$_POST['email'];
$street=$_POST['street'];
$city=$_POST['city'];
$zip=$_POST['zip'];
$pn=$_POST['pn'];
$vol="no";
$status="child";
$year=Date('Y');
do_html_header("");
if(check_user()){
	show_nav_menu();
  	show_user_page();
insert_child($status,$name,$grade,$email,$street,$city,$zip,$pn);
header('Location: user_page.php');
}
?>
<?php


do_html_footer();

?>