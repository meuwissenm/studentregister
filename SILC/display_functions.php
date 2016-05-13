<?php

function do_html_header($title = '') {
  // print an HTML header
?>
  <html>
  <head>
    <title><?php echo $title; ?></title>
    <style>
      body{
        background-image: url(images/back.jpg);
        background-size: 2000px 1400px;
        background-position:center;
        background-origin:content;
        background-repeat:no-repeat;
        }
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 25px; color: black; margin: 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 15px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 15px }
      hr { color: #FF0000; width=70%; text-align=center}
      a { color: black position:fixed; left:0px; bottom:0px; text-decoration:none}
    </style>
  </head>
  <body background="images.jpg">
  <table width="100%" border="0" cellspacing="0" bgcolor="red">
  <tr>
  <td rowspan="2">
  <a href="index.php"><img src="images/silc logo.jpg" alt="SILC" border="0"
       align="left" valign="bottom" height="55" width="325"/></a>
  </td>
  </tr>
  </table>
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function show_nav_menu(){
?>
<div>
    <a style="float:right" href="index.php">Home</a>  <a style="float:right" href ="user_page.php">User Home | </a>  <a style="float:right" href="admin.php">Admin Home | </a>  <a style="float:right" href ="logout.php">Logout | </a>
</div>
<?php
}

function index_footer(){
?>
	<hr>
	<a href="index.php">Home</a>
	</body>
	</html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h2><?php echo $heading; ?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
<?php
}


function display_login_form() {
  // dispaly form asking for name and password
?>
 <form method="post" action="process_login.php">
 <table bgcolor="lightgray">
   <tr>
     <td>Email:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="passwd"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
   <tr>
 </table></form>
<?php
}


function display_course_form(){
$electives = read_file('elective.txt');
$languages = read_file('language.txt');
?>
<table bgcolor="lightgreen">
	<tr>
		<td>SILC offers Languages, Social Studies and other Cultural Electives on Saturday.  Saturday schedule is as followed:<br><br>
		<li>Languages 10:00 am - 10:55 am</li>
		<li>Social Studies 11:00 am - 11:55 am</li>
		<li>Electives 12:00 am - 12:55 am</li><br><br></td></tr>
	<tr>
		<td><b>Indian Languages:</b><br><br>
		Language offerings based on minimum 5 registered signups.<br><br>
		<?php
		foreach($languages as $language){
		echo '<li>'.$language.'</li>';
		}
		echo '<br></td></tr>';?>
	<tr>
		<td><b>Social Studies:</b><br><br>
		Social Studies classes are for students to learn more about Indian celebrations, geography, history and important people in age-appropriate settings.<br><br>
		Students will be placed according to grade level.</td><br><br></tr>
	<tr>
			<td><b>Early Learning:</b><br><br>
			Preschool is offer for children ages 4-5.</td><br><br></tr>
	<tr>
		<td><b>Electives:</b><br><br>
		<?php
		foreach($electives as $elective){
		echo '<li>'.$elective.'</li>';
				}
		echo '<br></td></tr>';?>
	</tr>
	</table>
<?php
}

function show_admin_menu(){
?>
	<a href	="admin_create.php">Create User Account</a><br />

	<hr>

<?php
}

function show_user_page(){
?>
	<a href ="add_child_form.php">Add child to account</a><br />
	<br>
<?php
}

function show_register_form(){
?>
	<form method="post" action="register_user.php">
	 <table bgcolor="lightgreen">
	   <tr>
	     <td>Email:<br>
	     (This will be your login)</td>
	     <td><input type="text" name="username"/></td></tr>
	   <tr>
	     <td>Password:<br>(between 6 and 16 chars)</td>
	     <td><input type="password" name="passwd"/></td></tr>
	   <tr>
	   	 <td>Confirm password:</td>
	   	 <td><input type="password" name="passwd2"/></td></tr>
	   <tr>
	   	 <td>Name:</td>
	   	 <td><input type="text" name="stuname"/></td></tr>
	   <tr>
	   	 <td>Street Address:</td>
	   	 <td><input type="text" name="street"/></td></tr>
	   <tr>
	   	 <td>City:</td>
		 <td><input type="text" name="city"/></td></tr>
	   <tr>
	     <td>Zip Code:</td>
	   	 <td><input type="text" name="zipcode"/></td></tr>
	   <tr>
	   	 <td>Phone Number:</td>
	   	 <td><input type="text" name="pnumber"/></td></tr>
	   <tr>
	     <td colspan="2" align="center">
	     <input type="submit" value="Register"/></td></tr>
	   <tr>
	 </table></form>
	<?php
}
function show_admin_register_form(){
?>
	<form method="post" action="admin_register_user.php">
	 <table bgcolor="lightgreen">
	   <tr>
	     <td>Email:<br>
	     (This will be your login)</td>
	     <td><input type="text" name="username"/></td></tr>
	   <tr>
	     <td>Password:<br>(between 6 and 16 chars)</td>
	     <td><input type="password" name="passwd"/></td></tr>
	   <tr>
	   	 <td>Confirm password:</td>
	   	 <td><input type="password" name="passwd2"/></td></tr>
	   <tr>
	   	 <td>Name:</td>
	   	 <td><input type="text" name="stuname"/></td></tr>
	   <tr>
	   	 <td>Street Address:</td>
	   	 <td><input type="text" name="street"/></td></tr>
	   <tr>
	   	 <td>City:</td>
		 <td><input type="text" name="city"/></td></tr>
	   <tr>
	     <td>Zip Code:</td>
	   	 <td><input type="text" name="zipcode"/></td></tr>
	   <tr>
	   	 <td>Phone Number:</td>
	   	 <td><input type="text" name="pnumber"/></td></tr>
	   <tr>
	     <td colspan="2" align="center">
	     <input type="submit" value="Register"/></td></tr>
	   <tr>
	 </table></form>
	<?php
}

function display_user_courses($courses){
?>
<form method="post" action="process_drop.php">
<table bgcolor="lightgreen" width ="300">
  <tr bgcolor="lightgray">
    <td><b><font size = "3">Course</font><b></td>
    <td width ="20%"><b><font size = "3">Drop?</font><b></td>
<?php
foreach($courses as $course){
	echo "<tr>";
	echo "<td>".$course."</td>";
	echo "<td><input type=\"checkbox\" name=\"del_me[]\"
	value=\"".$course."\"/></td>";
	echo "</tr>";
}
?>
<tr>
  <td colspan="2" align="center">
  <input type="submit" value="Drop"/></td></tr>
</table></form>
<?php
}

function display_course_register($email){
	$electives = read_file('elective.txt');
	$languages = read_file('language.txt');
?>
<form method="post" action="process_register.php">;
<table bgcolor="lightgreen" width ="400">
  <tr>
    <td><b><font size="2">Social Studies?</font></b></td>
    <td><input type="radio" name="scourse" value="yes">Yes<input type="radio" name="scourse" value="no" checked>No</td>
  <tr>
    <td><b><font size="2">Preschool?</font></b></td>
	<td><input type="radio" name="pcourse" value="yes">Yes<input type="radio" name="pcourse" value="no" checked>No</td>
  <tr>
    <td><b><font size="2">Language?</font></b></td>
    <td width=40%><select name='language'>
    <option value="No">No</option>;
    <?php
    foreach($languages as $language){
    	echo '<option value="'.$language.'">'.$language.'</option>';
    }
    ?>
    </select></td>
  <tr>
     <td><b><font size="2">Elective?</font></b></td>
	 <td><select name='elective'>
	 <option value="No">No</option>;
	 <?php
	 foreach($electives as $elective){
	     echo '<option value="'.$elective.'">'.$elective.'</option>';
	 }
	 ?>
    </select></td>
  <tr>
    <td><input type="hidden" name ="user" value="<?php echo $email; ?>"></td></tr>
  <tr>
	 <td colspan="2" align="center">
	 <input type="submit" value="Process"/></td></tr>
  </table></form>
<?php
}
?>
<script>
function disable(){
	document.getElementById("pre").disabled=true;
	}
function enable(){
	document.getElementById("pre").disabled=false;

	}
function disablethree(){
	document.getElementById("ss").disabled=true;
	document.getElementById("lang").disabled=true;
	document.getElementById("elect").disabled=true;
	}
function enablethree(){
	document.getElementById("ss").disabled=false;
	document.getElementById("lang").disabled=false;
	document.getElementById("elect").disabled=false;
	}
function langenable(){
	var x = document.getElementById("lang").value;
	if(x == "no"){
		enable();
		}else{
		disable();
		}
	}
function electenable(){
	var x = document.getElementById("elect").value;
	if(x == "no"){
		enable();
		}else{
		disable();
		}
	}

</script>
<?php
function display_course_child($name){
	$electives = read_file('elective.txt');
	$languages = read_file('language.txt');
?>
<form method="post" action="process_register_child.php">
<table bgcolor="lightgreen" width ="400">
  <tr>
    <td><b><font size="2">Preschool?<br>(Only for ages 5 and under.)</font></b></td>
  	<td><input type="radio" id="pre" onclick="disablethree()" name="pcourse" value="yes">Yes<input type="radio" name="pcourse" onclick="enablethree()" value="no" checked>No</td>
  <tr>
    <td><b><font size="2">Social Studies?<br>(Age > 5)</font></b></td>
    <td><input type="radio" id="ss" name="scourse" onclick="disable()" value="yes">Yes<input type="radio" name="scourse" onclick="enable()" value="no" checked>No</td>
  <tr>
    <td><b><font size="2">Language?<br>(Age > 5)</font></b></td>
    <td width=40%><select name='language' id="lang" onchange="langenable()">
    <option value="no">no</option>;
    <?php
    foreach($languages as $language){
    	echo '<option value="'.$language.'">'.$language.'</option>';
    }
    ?>
    </select></td>
  <tr>
     <td><b><font size="2">Elective?<br>(Age > 5)</font></b></td>
	 <td><select name='elective' id="elect" onchange="electenable()">
	 <option value="no">no</option>;
	 <?php
	 foreach($electives as $elective){
	     echo '<option value="'.$elective.'">'.$elective.'</option>';
	 }
	 ?>
    </select></td>
  <tr>
    <td><input type="hidden" name ="user" value="<?php echo $name; ?>"></td></tr>
  <tr>
	 <td colspan="2" align="center">
	 <input type="submit" value="Register"/></td></tr>
  </table></form>
<?php
}

function add_child($email){

 	 	$conn = db_connect();

 	 	$query = "select * from userinfo where email='".$email."'";

 	 	$result = $conn->query($query);

		if(!$result){
			return 0;
			}

		$row=$result->fetch_assoc();
		$email=$row['email'];
		$street=$row['street'];
		$city=$row['city'];
		$zip=$row['zipcode'];
		$pn=$row['phonenumber'];
		?>


		<form method="post" action="process_child.php">
		<table bgcolor="lightgreen">
			  <tr>
			     <td>Child Name:</td>
			     <td><input type="text" name="child"/></td></tr>
			  <tr>
			  	 <td>Grade In School:</td>
			  	 <td><input type="text" name="grade"/></td></tr>
			  <tr>
    			 <td><input type="hidden" name ="email" value="<?php echo $email; ?>"></td></tr>
    		  <tr>
    			 <td><input type="hidden" name ="street" value="<?php echo $street; ?>"></td></tr>
    		  <tr>
    			 <td><input type="hidden" name ="city" value="<?php echo $city; ?>"></td></tr>
    		  <tr>
    			 <td><input type="hidden" name ="zip" value="<?php echo $zip; ?>"></td></tr>
    		  <tr>
    			 <td><input type="hidden" name ="pn" value="<?php echo $pn; ?>"></td></tr>
			  <tr>
			  <td colspan="2" align="center">
			  	 <input type="submit" value="Add"/></td></tr>
  </table></form>
  <?php

 }


function show_family($email){

 	$conn = db_connect();

 	$query = "select * from userinfo where email='".$email."';";

 	$result = $conn->query($query);

 	if(!$result){
 	return 0;
 	}else{
 	?>

	 	<form method="post" action="process_child_page.php">
	 	<table bgcolor="lightgreen" width="300" border="1" cellspacing="0" align="center">
	 	<tr bgcolor="lightgray">
	 		<td><b><font size ="3">Id</font></b></td>
 		  	<td><b><font size ="3">Name</font></b></td>
 		  	<td width ="10%"><b><fontsize="3">Edit</font></b></td></tr>
 		  	<?php
 		  	$count = 1;
 		  	while($row=$result->fetch_assoc()){
 		  	  echo "<tr>";
			  echo "<td>".$count."</td>";
 	 	  	  echo "<td>".$row['name']."</td>";
 	 	  	  ?>
 	 	  	  <input type="hidden" name="email" value="<?php echo $email ?>">
 			  <td><button name='edit' type="submit" value="<?php echo $row['name'] ?>">Edit</button></td></tr>
 			  <?php
 			  $count=$count+1;
 			  }
 			  ?>
 			  </table></form>
 			  <?php
 			  }
 			  }

?>

