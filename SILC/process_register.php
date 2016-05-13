<?php
include_once('functions.php');
session_start();
$email=$_POST['user'];
$pp=$_POST['pcourse'];
$ss=$_POST['scourse'];
$lang=$_POST['language'];
$elect=$_POST['elective'];
do_html_header();
If(check_user()){
show_nav_menu();
show_user_page();
}
If(check_admin_user()){
show_nav_menu();
show_admin_menu();
}
?>
<hr>
<?php
$stuname = get_studentname($email);
if($ss != 'no'){
	if(validate_course("social studies",$stuname)){
	add_course("social studies","Social Studies" ,$stuname,$email);
	echo "Social Studies was added successfully<br>";
	}
}
if($pp != 'no'){
	if(validate_course("preschool",$stuname)){
	add_course("preschool","Preschool" ,$stuname,$email);
	echo "Preschool was added successfully<br>";
	}
}
if($lang != "no" && $lang != NULL){
	if(validate_course("language",$stuname)){
	add_course("language",$lang,$stuname,$email);
	echo $lang." was added successfully<br>";
	}
}
if($elect != "no" $elect != NULL){
if(validate_course("elective",$stuname)){
	add_course("elective",$elect,$stuname,$email);
	echo $elect." was added successfully<br>";
	}
}

  //$array = get_student_courses($email);
 // echo '<p><font size="4">Current registered course(s)</font></p>';
  //display_user_courses($array);
If(check_user()){
header('Location: user_page.php');
}

If(check_admin_user()){
header('Refresh:3; url=admin_show_user_info.php');
}
do_html_footer();

?>