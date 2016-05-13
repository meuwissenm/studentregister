<?php

// include function files for this application
require_once('functions.php');
session_start();


if (($_POST['username']) && ($_POST['passwd'])) {
	// they have just tried logging in

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if (login($username, $passwd)) {
      // if they are in the database register the user id
      //$_SESSION['admin_user'] = $username;
      if (check_admin_user()) {
      	//do_html_header("Administration");
        //show_admin_menu();
        header('Location: admin.php');
      } elseif(check_user()){
        //do_html_header("Hello ".$_SESSION['valid_user']);
        //show_user_page();
        header('Location: user_page.php');
      }
      do_html_footer();


   }else {
      // unsuccessful login
      do_html_header("Problem:");
      show_nav_menu();
      header('Refresh:2; url=index.php');
      echo "<p>You could not be logged in.<br/>
            You must be logged in to view this page.</p>";
      do_html_footer();
      exit;
    }
}

