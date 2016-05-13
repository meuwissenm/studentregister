<?php
include_once('functions.php');
session_start();
$name=$_POST['name'];
$street=$_POST['street'];
$city=$_POST['city'];
$zip=$_POST['zip'];
do_html_header("");
if(check_admin_user()){
update_address_db($name,$street,$city,$zip);
header('Location: admin.php');
}
?>
<?php


do_html_footer();

?>