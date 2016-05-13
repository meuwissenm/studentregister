<?php

//require_once('functions.php');

function login($username, $password) {
// check username and password with db
// if yes, return true
// else return false

  // connect to db
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  // check if username is unique
  $result = $conn->query("select * from users
                         where username='".$username."'
                         and password = sha1('".$password."')");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
  	$row = $result->fetch_assoc();

        //admin is true
        if ($row["admin"] == "yes") {
            $_SESSION['admin_user'] = $username;
            return 1;
        } //admin is false
        else {
            $_SESSION['valid_user'] = $username;
            return 1;
        }
    } else {
		return 0;
    }
}

function check_admin_user() {
// see if somebody is logged in and notify them if not

  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}

function check_user() {

	if(isset($_SESSION['valid_user'])) {
		return true;
	}else{
		return false;
	}
}
function insert_user($email, $pass) {
  //insert user into users database

  $conn = db_connect();

  $query = "insert into users (username, password) values
  	('".$email."', sha1('".$pass."'))";

  $result = $conn->query($query);
  if(!$result) {
  	throw new Exception('Registration failed - try again later.');
  }else{
  	return true;
	}

 }

function insert_user_info($stat,$student,$email, $street,$city,$zip, $phone){
	$year = date('Y');
	$conn = db_connect();

	$query = "insert into userinfo (status,name, email, street,city,zipcode,phonenumber,joined)
		values ('".$stat."','".$student."','".$email."','".$street."','".$city."','".$zip."','".$phone."','".$year."')";

	$result = $conn->query($query);
	if(!$result) {
		throw new Exception('Registration failed - try again later.');
	}else {
		return true;
		}
	}
function insert_child($stat,$student,$grade,$email,$street,$city,$zip,$phone){
	$year = date('Y');
	$conn = db_connect();

	$query = "insert into userinfo (status,name,grade,email, street,city,zipcode,phonenumber,joined)
		values ('".$stat."','".$student."','".$grade."','".$email."','".$street."','".$city."','".$zip."','".$phone."','".$year."')";

	$result = $conn->query($query);
	if(!$result) {
		throw new Exception('Registration failed - try again later.');
	}else {
		return true;
		}
	}

function validate_course($cate, $stuname){

	$conn = db_connect();

	$query = "select * from registercourses where category='".$cate."' and student = '".$stuname."'";

	$result = $conn->query($query);

	if($result->num_rows ==0){
		return true;
		}else{
		return false;
		}
	}
 ?>