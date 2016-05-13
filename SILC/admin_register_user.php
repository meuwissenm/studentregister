<?php
// include function files for this application
//create short variable names
require_once('functions.php');
require_once('db_functions.php');
//$vol=$_POST['volunteer'];
$email=$_POST['username'];
$passwd=$_POST['passwd'];
$passwd2=$_POST['passwd2'];
$student=$_POST['stuname'];
//$parent=$_POST['pname'];
$street=$_POST['street'];
$city=$_POST['city'];
$zip=$_POST['zipcode'];
$phone=$_POST['pnumber'];
// start session which may be needed later
// start it now because it must go before headers
session_start();
try {
// check forms filled in
if (!filled_out($_POST)) {
throw new Exception('You have not filled the form out correctly –
please go back and try again.');
}

// email address not valid
if (!valid_email($email)) {
throw new Exception('That is not a valid email address.
Please go back and try again.');
}
// passwords not the same
if ($passwd != $passwd2) {
throw new Exception('The passwords you entered do not match –
please go back and try again.');
}
// check password length is ok
// ok if username truncates, but passwords will get
// munged if they are too long.
if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
throw new Exception('Your password must be between 6 and 16 characters.
Please go back and try again.');
}
// attempt to register
// this function can also throw an exception
$connect = db_connect();
$check = "SELECT * FROM userinfo WHERE email = '$_POST[username]'";
$rs = mysqli_query($connect, $check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if ($data[0] > 1) {
	$message = "Email Address already registered - please login";
    header('Refresh:2; url=index.php');
	echo "Email Address already registered - please login";
} else {
insert_user($email, $passwd);
$stat='parent';
insert_user_info($stat,$student,$email, $street,$city,$zip, $phone);
// register session variable
//$_SESSION['valid_user'] = $email;
// provide link to members page
//do_html_header('Registration successful');
header('Refresh:2; url=admin.php');
echo 'The registration was successful.';
//echo '<br>';
}
//echo '<p><a href="register_form.php">Register for courses now</a><br>';
//echo '<p><a href="user_page.php">User Home</a></p>';
//<a href="register_form.php">Register for courses now</a>
?>

<?php
// end page
do_html_footer();
}
catch (Exception $e) {
do_html_header('Problem:');
echo $e->getMessage();
do_html_footer();
exit;
}

?>