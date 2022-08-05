<?php session_start(); ?>
<?php require_once ('inc/connection.php'); ?>
<?php require_once ('inc/functions.php'); ?>
<?php 

	//cheking if a user is logged in 
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');
	}

	$errors = array();
	$user_id = '';
	$first_name = '';
	$last_name = '';
	$email = '';
	$password = '';

	if (isset($_GET['user_id'])){
		//geting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id'] );
		$query = "SELECT * FROM user WHERE id = {$user_id} LIMIT 1 ";

		$result_set = mysqli_query($connection, $query);

		if ($result_set){
			if (mysqli_num_rows($result_set) == 1){
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$first_name = $result['first_name'];
				$last_name = $result['last_name'];
				$email = $result['email'];
			}else{
				//user not found
				header('Location: users.php?err=user_not_found');
			}
		} else{
			// query unsuccessful
			header('Location: users.php?err=query_faild');
		}
	}

	if(isset($_POST['submit'])){
	$user_id = $_POST['user_id'];
	$password = $_POST['password'];



		//cheking required feild

		$req_fields = array('user_id', 'password', );

		foreach($req_fields as $field){
			if(empty(trim($_POST[$field]))){
			$errors[]= $field .' is required';
			}

		}

		//cheking max length

		$max_len_fields = array('password' => 50 );

		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) >$max_len){
			$errors[]= $field .' must be less than' . $max_len . ' characters';
			}

		}


		if(empty($errors)){
			// no errors found. adding new record
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);
			
			
			$query = "UPDATE user SET ";
			$query .= "password = '{$hashed_password}' ";
			$query .= "WHERE id = {$user_id} LIMIT 1 ";

			$result = mysqli_query($connection, $query);

			if($result)	{
				// query successful. redirect to user page
				header('Location: users.php?user_modified=true');
			} else{
				$errors[] = 'Failed to update the password.';
			}
		}

	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link rel="stylesheet" href="css/main.css">

</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?> <a href="logout.php">Log out </a> </div>

	</header>

	<main>
		<h1>Change Password<span><a href="users.php">< Back to user list </a></span>  </h1>

		<?php 

		if(!empty($errors)){
			echo '<div class="errmsg">';
			echo '<b>There were errors on form </b><br><br>';
			foreach ($errors as $error) {
				$error = ucfirst(str_replace("_"," ", $error));
				echo $error . '<br>';
			}
			echo '</div>';
		}

		 ?>

		<form action="change-password.php" method="post" class="userform">

			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			
			<p>
				<label for="">First Name:</label>
				<input type="text" name="first_name" <?php echo 'value="' .$first_name . '"'; ?> disabled>
			</p>

			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" <?php echo 'value="' .$last_name . '"'; ?> disabled>
			</p>

			<p>
				<label for="">Email:</label>
				<input type="email" name="email" <?php echo 'value="' .$email . '"'; ?> disabled>
			</p>

			<p>
				<label for="">New Password:</label>
				<input type="password" name="password" id="password">
			</p>

			<p>
				<label for="">Show Password:</label>
				<input type="checkbox" name="showpassword" id="showpassword" style="width:20px; height: 20px">
			</p>

			<p>
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Update Password</button>
			
			</p>



		</form>



	</main>

<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$('#showpassword').click(function(){
			if($('#showpassword').is(':checked')){
				$('#password').attr('type','text');
			} else {
				$('#password').attr('type','password');
			}
		})
	});

</script>

</body>
</html>