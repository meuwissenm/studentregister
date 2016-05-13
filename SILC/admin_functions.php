<?php
include_once('functions.php');

function admin_add_form($email, $lines){
?>
  <form method="post" action="admin_process_add.php">
  <table bgcolor = "lightgreen">
  <tr>
  	<td>Which course would you like to add for the student?</td>
  	<td><select name='add'>
  	<?php
  	foreach($lines as $line){
  		echo '<option value="'.$line.'">'.$line.'</option>';
  	}
  	?>
  	</select></td>
  <tr>
  	<input type="hidden" name="email" value="<?php echo $email?>">
  	<td colspan="2" align="center">
  	<input type="submit" value="Process"/></td></tr>
  </table></form>
 <?php
 }

function read_file($file){
	$lines = explode("\n",file_get_contents($file));
	foreach($lines as $line){
		preg_replace('/\\[rn]/','',$line);
		}
	return $lines;

}

function add_course($cate,$course, $name, $email) {
  //insert user into users database
  $year = date('Y');
  $conn = db_connect();

  $query = "insert into registercourses (category,course, student, username, year) values
  	('".$cate."','".$course."','".$name."','".$email."','".$year."')";

  $result = $conn->query($query);
  if(!$result) {
  	throw new Exception('Process failed - make sure email is correct.');
  }else{
  	return true;
	}

 }

 function get_studentname($email){
	try{
     $conn = db_connect();

     $query = "select name from userinfo where email='".$email."'";

     $result = $conn->query($query);
     if(!$result) {
     	return 0;
     	}
     if($result->num_rows==0){
     	throw new Exception('Student does not exist - make sure email is correct.');
     }else{
     	$row = $result->fetch_assoc();
     	return $row['name'];
     	}
   	}catch(Exception $e){
   	echo $e->getMessage();
   	do_html_footer();
   	exit;
   	}

}
 function get_studentemail($name){
	try{
     $conn = db_connect();

     $query = "select email from userinfo where name='".$name."'";

     $result = $conn->query($query);
     if(!$result) {
     	return 0;
     	}
     if($result->num_rows==0){
     	throw new Exception('Student does not exist - make sure name is correct.');
     }else{
     	$row = $result->fetch_assoc();
     	return $row['email'];
     	}
   	}catch(Exception $e){
   	echo $e->getMessage();
   	do_html_footer();
   	exit;
   	}

}

 function admin_drop_form(){
 ?>
   <form method="post" action="admin_drop.php">
   <table bgcolor = "lightgreen">
   <tr>
   	<td>Account Email:</td>
   	<td><input type="text" name="email"/></td></tr>
   <tr>
   	<td colspan="2" align="center">
   	<input type="submit" value="View"/></td></tr>
  </table></form>
  <?php
  }

function get_student_courses($email){
 	$conn = db_connect();

 	$query = "select course from registercourses where username='".$email."'";

 	$result = $conn->query($query);

 	if(!$result){
 		return 0;
 		}
 	try {
 	if($result->num_rows==0){
 		throw new Exception('Student is not register for any course yet.');
 	}else{
		while($rows = $result->fetch_assoc()){
			$array[] = $rows['course'];
		}
		return $array;
	}
	}catch(Exception $e){
	echo $e->getMessage();
	do_html_footer();
	exit;
	}
}
function get_child_courses($name){
 	$conn = db_connect();

 	$query = "select course from registercourses where student='".$name."'";

 	$result = $conn->query($query);

 	if(!$result){
 		return 0;
 		}
 	try {
 	if($result->num_rows==0){
 		throw new Exception('Student is not registered for any course yet.');
 	}else{
		while($rows = $result->fetch_assoc()){
			$array[] = $rows['course'];
		}
		return $array;
	}
	}catch(Exception $e){
	echo $e->getMessage();
	do_html_footer();
	exit;
	}
}
//drop a drop for a student
function drop_course($email, $course){
	$conn = db_connect();

	if (!$conn->query("delete from registercourses where username='".$email."'
		and course='".$course."'")){
		throw new Exception('Course could not be dropped');
	}
	return true;
}
function drop_child_course($name,$course){
	$conn = db_connect();

	if (!$conn->query("delete from registercourses where student='".$name."'
		and course='".$course."'")){
		throw new Exception('Course could not be dropped');
	}
	return true;
}

//show the courses of a particular user from edit button
function admin_user_courses($courses, $user){
?>
<form method="post" action="admin_process_drop.php">
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
  <td><input type="hidden" name ="email" value="<?php echo $user; ?>"></td></tr>
<tr>
  <td colspan="2" align="center">
  <input type="submit" value="Drop"/></td></tr>
</table></form>
<?php
}
function child_courses($courses, $name){
?>
<form method="post" action="child_drop.php">
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
  <td><input type="hidden" name ="name" value="<?php echo $name; ?>"></td></tr>
<tr>
  <td colspan="2" align="center">
  <input type="submit" value="Drop"/></td></tr>
</table></form>
<?php
}
//generate a single classlist not being used now
function admin_classlist_form(){
	$courses = read_file('allcourses.txt');
?><br>
  <form method="post" action="admin_process_cl.php">
  <table bgcolor="lightgreen" align="center" border="1">
  <tr>
    <td>Which course would you like to generate an individual classlist for?</td>
    <td><select name='list'>
    <?php
    foreach($courses as $course){
    	echo '<option value="'.$course.'">'.$course.'</option>';
    }
    ?>
    </select></td>
  <tr>
    <td colspan="2" align="center">
    <input type="submit" value="Generate"/></td></tr>
  </table></form>
 <?php
 }
//generate all classlist
 function generate_classlist(){
	try{
 	$conn = db_connect();

 	$query = "select * from registercourses order by course";

 	$result = $conn->query($query);

 	if(!$result){
 		return 0;
 	}

 	if($result->num_rows==0){
 		echo 'No classlist available.';
 	}else{
 	?>
 	<p><b><font size="4">Classlists</font></b></p>
 	<table bgcolor="lightgreen" width="500" border="1" cellspacing="0" align="center">
 	<tr bgcolor="lightgray">
 	  <td width="30%"><b><font size="3">Course</font></b></td>
 	  <td width="30%"><b><font size="3">Student name</font></b></td>
 	  <td><b><fontsize="3">Email</font></b></td></tr>
 	  <?php
 	  while($row=$result->fetch_assoc()){
 	  	echo "<tr>";
 	  	echo "<td>".$row['course']."</td>";
 	  	echo "<td>".$row['student']."</td>";
 	  	echo "<td>".$row['username']."</td></tr>";

 	  	}
 	  	?>
 	  	</table>
 	  	<?php
 	 }
 }catch(Exception $e){
   	echo $e->getMessage();
   	do_html_footer();
   	exit;
   	}
 }
  function generate_one_classlist($course){
 	try{
  	$conn = db_connect();

  	$query = "select * from registercourses where course='".$course."'";

  	$result = $conn->query($query);

  	if(!$result){
  		return 0;
  	}

  	if($result->num_rows==0){
  		echo 'No classlist available.';
  	}else{
  	?>
  	<p><b><font size="4">Classlist for <?php echo $course;?></font></b></p>
  	<table bgcolor="lightgreen" width="300" border="1" cellspacing="0" align="center">
  	<tr bgcolor="lightgray">
  	  <td width="30%"><b><font size="3">Student name</font></b></td>
  	  <td><b><fontsize="3">Email</font></b></td></tr>
  	  <?php
  	  while($row=$result->fetch_assoc()){
  	  	echo "<tr>";
  	  	echo "<td>".$row['student']."</td>";
  	  	echo "<td>".$row['username']."</td></tr>";

  	  	}
  	  	?>
  	  	</table>
  	  	<?php
  	 }
  }catch(Exception $e){
    	echo $e->getMessage();
    	do_html_footer();
    	exit;
    	}
 }
//show all register user table in admin page
 function generate_regis_users(){
 	try{
	 	$conn = db_connect();

	 	$query = "select student,username from registercourses where year=2016 group by student";

	 	$result = $conn->query($query);

	 	if(!$result){
	 		return 0;
	 	}

	 	if($result->num_rows==0){
	 		echo 'No one has register.';
 	}else{
 ?>
 		<p><b><font size="4">Registered Students for <?php echo date('Y');?></font></b><br>
 		<font size="3">(delete will permanently remove<br>user from all registered course(s))</font></p>
 		<form method="post" action="process_admin.php">
 	 	<table bgcolor="lightgreen" width="700" border="1" cellspacing="0" align="center">
	 	<tr bgcolor="lightgray">
	 	  <td width="10%"><b><font size="3">Id</font></b></td>
	 	  <td width="30%"><b><font size="3">Student name</font></b></td>
	 	  <td><b><fontsize="3">Email</font></b></td>
	 	  <td width="10%"><b><fontsize="3">Edit</font></b></td>
	 	  <td width="10%"><b><fontsize="3">Delete</font></b></td></tr>
	 	  <?php
	 	  $count = 1;
	 	  while($row=$result->fetch_assoc()){
	 	  	echo "<tr>";
	 	  	echo "<td>".$count."</td>";
	 	  	echo "<td>".$row['student']."</td>";
	 	  	echo "<td>".$row['username']."</td>";
	 	    //echo "<td><input type=\"submit\" name=\"edit_me[]\"
			//value=\"Edit\"/></td>";
			//echo "<td><input type=\"submit\" name=\"del_me[]\"
			//value=\"Delete\"/></td>";
			?>
			<td><button name='edit' type="submit" value="<?php echo $row['student'] ?>">Edit</button></td>
			<td><button name='delete' type="submit" value="<?php echo $row['student'] ?>">Delete</button></td></tr>
			<?php
			$count= $count +1;

	 	  	}
	 	  	?>
	 	  	</table></form>
	 	  	<?php
	 	 }
	 }catch(Exception $e){
	   	echo $e->getMessage();
	   	do_html_footer();
	   	exit;
	   	}
 }
//wipe user out of the whole system
 function delete_user($name){
	//$email=get_studentemail($name);
 	$conn = db_connect();

 	$query1 = "delete from registercourses where student='".$name."'";

	//$query2 = "delete from users where username ='".$name."'";

	//$query3 = "delete from userinfo where email ='".$name."'";

 	$result = $conn->query($query1);

	//$result2 = $conn->query($query2);

	//$result3 = $conn->query($query3);
 	//if(!$result){
 		//echo "DID NOT WORK";
 		//}
 	//header('Location: admin.php');

 }


 function show_users(){
 	try{
	 	$conn = db_connect();

	 	$query = "select * from users order by admin";

	 	$result = $conn->query($query);

	 	if(!$result){
	 		return 0;
	 	}

	 	if($result->num_rows==0){
	 		throw new Exception('No one has register.');
 	}else{
 ?>
 		<p><b><font size="4">All Users</font></b></p>
 		<form method="post" action="process_admin.php">
 	 	<table bgcolor="lightgreen" width="400" border="1" cellspacing="0" align="center">
	 	<tr bgcolor="lightgray">
	 	  <td width="10%"><b><font size="3">Id</font></b></td>
	 	  <td width="70%"><b><font size="3">Username</font></b></td>
	 	  <td><b><fontsize="3">Admin</font></b></td>
	 	  <?php
	 	  $count = 1;
	 	  while($row=$result->fetch_assoc()){
	 	  	echo "<tr>";
	 	  	echo "<td>".$count."</td>";
	 	  	echo "<td>".$row['username']."</td>";
	 	  	echo "<td>".$row['admin']."</td>";

			$count= $count +1;

	 	  	}
	 	  	?>
	 	  	</table></form>
	 	  	<?php
	 	 }
	 }catch(Exception $e){
	   	echo $e->getMessage();
	   	do_html_footer();
	   	exit;
	   	}
 }

//show all users info in table in generate alluser admin link
  function show_user_info(){
  	try{
 	 	$conn = db_connect();

 	 	$query = "select * from userinfo order by name";

 	 	$result = $conn->query($query);

 	 	if(!$result){
 	 		return 0;
 	 	}

 	 	if($result->num_rows==0){
 	 		echo 'No user in the system.';
  	}else{
  ?>
  		<p><b><font size="4">User Information</font></b></p>
  		<form method="post" action="process_user.php">
  	 	<table bgcolor="lightgreen" width="1200" border="1" cellspacing="0" align="center">
 	 	<tr bgcolor="lightgray">
 	 	  <td width="5%"><b><font size="3">Id</font></b></td>
 	 	  <td width="10%"><b><font size="3">Status</font></b></td>
 	 	  <td width="10%"><b><font size="3">Name</font></b></td>
 	 	  <td width="5%"><b><font size="3">Grade</font></b></td>
 	 	  <td width="20%"><b><font size="3">Email</font></b></td>
 	 	  <td width="15%"><b><font size="3">Street</font></b></td>
 	 	  <td width="15%"><b><font size="3">City</font></b></td>
 	 	  <td width="5%"><b><font size="3">Zip Code</font></b></td>
 	 	  <td width="10%"><b><font size="3">Phone Number</font></b></td>
 	 	  <td width="5%"><b><font size="3">Year Join</font></b></td>
 	 	  <td width="5%"><b><font size="3">Edit</font></b></td>
 	 	  <td width="5%"><b><font size="3">Update</font></b></td></tr>

 	 	  <?php
 	 	  $count = 1;
 	 	  while($row=$result->fetch_assoc()){
 	 	  	echo "<tr>";
 	 	  	echo "<td>".$count."</td>";
 	 	  	//echo "<td>".$row['volunteer']."</td>";
 	 	  	echo "<td>".$row['status']."</td>";
 	 	  	echo "<td>".$row['name']."</td>";
 	 	  	echo "<td>".$row['grade']."</td>";
 	 	  	echo "<td>".$row['email']."</td>";
 	 	  	echo "<td>".$row['street']."</td>";
 	 	  	echo "<td>".$row['city']."</td>";
 	 	  	echo "<td>".$row['zipcode']."</td>";
 	 	  	echo "<td>".$row['phonenumber']."</td>";
 	 	  	echo "<td>".$row['joined']."</td>";
 	 	  	?>
 	 	  	<td><button name='edit' type="submit" value="<?php echo $row['name'] ?>">Edit</button></td>
 	 	  	<td><button name='update' type="submit" value="<?php echo $row['name'] ?>">Update</button></td>
			</tr>

			<?php
 			$count= $count +1;

 	 	  	}
 	 	  	?>
 	 	  	</table></form>
 	 	  	<?php
 	 	 }
 	 }catch(Exception $e){
 	   	echo $e->getMessage();
 	   	do_html_footer();
 	   	exit;
 	   	}
 }
 function update_grade($name){
 ?>
 		<form method="post" action="update_grade.php">
 		<table bgcolor="lightgreen">
 			  <tr>
 			     <td><b>Update Grade</b></td>
 			  <tr>
 			  	 <td>Grade In School:</td>
 			  	 <td><input type="text" name="grade"/></td></tr>
 			  <tr><td><input type="hidden" name="name" value="<?php echo $name;?>">
 			  <td colspan="2" align="center">
 			  	 <input type="submit" value="Update"/></td></tr>
  </table></form>
 <?php
 }
 function update_address($name){
  ?>
  		<form method="post" action="update_address.php">
  		<table bgcolor="lightgreen">
  			  <tr>
  			     <td><b>Update Address</b></td>
  			  <tr>
			  	   	 <td>Street Address:</td>
			  	   	 <td><input type="text" name="street"/></td></tr>
			  	   <tr>
			  	   	 <td>City:</td>
			  		 <td><input type="text" name="city"/></td></tr>
			  	   <tr>
			  	     <td>Zip Code:</td>
			  	   	 <td><input type="text" name="zip"/></td></tr>
  			  <tr><td><input type="hidden" name="name" value="<?php echo $name;?>">
  			  <td colspan="2" align="center">
  			  	 <input type="submit" value="Update"/></td></tr>
   </table></form>
  <?php
 }

 function update_number($name){
  ?>
  		<form method="post" action="update_number.php">
  		<table bgcolor="lightgreen">
  			  <tr>
  			     <td><b>Update Phone Number</b></td>
  			  <tr>
  			  	 <td>New Number:</td>
  			  	 <td><input type="text" name="number"/></td></tr>
  			  <tr><td><input type="hidden" name="name" value="<?php echo $name;?>">
  			  <td colspan="2" align="center">
  			  	 <input type="submit" value="update"/></td></tr>
   </table></form>
  <?php
 }
 function update_grade_db($name,$grade){
   $conn = db_connect();

   $query = "update userinfo set grade='".$grade."' where name='".$name."'";

   $result = $conn->query($query);
   if(!$result) {
   	throw new Exception('Process failed');
   }else{
   	return true;
 	}

 }
  function update_address_db($name,$street,$city,$zip){
    $conn = db_connect();

    $query = "update userinfo set street='".$street."',
    			city='".$city."',
    			zipcode='".$zip."' where name='".$name."'";

    $result = $conn->query($query);
    if(!$result) {
    	throw new Exception('Process failed');
    }else{
    	return true;
  	}

 }
  function update_number_db($name,$pn){
    $conn = db_connect();

    $query = "update userinfo set phonenumber='".$pn."' where name='".$name."'";

    $result = $conn->query($query);
    if(!$result) {
    	throw new Exception('Process failed');
    }else{
    	return true;
  	}

 }


