<?php session_start(); ?>
<?php require_once ('inc/connection.php'); ?>
<?php require_once ('inc/functions.php'); ?>
<?php 

	//cheking if a user is logged in 
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');
	}


	if (isset($_GET['user_id'])){
		//geting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id'] );

		if( $user_id == $_SESSION['user_id']){
			//should not delete curent user
			header('Location: users.php?err=cannot_delete_current_user');
		} else {
			//delete the user
			$query = "UPDATE user SET is_deleted = 1 WHERE id = {$user_id} LIMIT 1";

			$result = mysqli_query($connection , $query);

			if($result){
				// user delete.
				header('Location: users.php?msg=user_detele');
			}else {
				header('Location: users.php?msg=delete_faild');
			}
		}
		
	} else {
		header('Location: users.php');
	}

	?>