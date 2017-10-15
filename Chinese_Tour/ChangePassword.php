<?php
require_once 'module/session.php';
require_once 'module/hashing.php';
include 'db_config.php';

if(not_logged_in() === TRUE) {
	header('location: login.html');
}
if($_POST) {
	$password = $_POST['password'];
	$npassword =  hashPassword($_POST["npassword"]);
	$cpassword = $_POST['cpassword'];


  if($password && $npassword && $cpassword) {
    if(passwordMatch($_SESSION['id'], $password) === TRUE) {

      if($npassword != $cpassword) {
        echo "New password does not match conform password <br />";
      } else {
        if(changePassword($_SESSION['id'], $npassword) === TRUE) {
					echo "Successfully updated";
        } else {
          echo "Error while updating the information <br />";
        }
      }

    } else {
      echo "Current Password is incorrect <br />";
    }
  }
}

 ?>
