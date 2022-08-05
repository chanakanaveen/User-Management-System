<?php session_start(); ?>
<?php require_once ('inc/connection.php'); ?>
<?php require_once ('inc/functions.php'); ?>
<?php 

//check for form submission
if(isset($_POST['submit'])){

	$errors = array();

	//check if username and password has been entered
	if(!isset($_POST['email'])|| strlen(trim($_POST['email'])) <1){
		$errors[] = 'Username is Missing / Invalid';

	}

	if(!isset($_POST['password'])|| strlen(trim($_POST['password'])) <1){
		$errors[] = 'Password is Missing / Invalid';

	}

//check if there are any error in the form
	if(empty($errors)){
	
	// save username and password into variables
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$hashed_password = sha1($password);

	// prepare database query
	$query = "SELECT * FROM user 
							WHERE email = '{$email}' 
							AND password = '{$hashed_password}'
							LIMIT 1  ";

	$result_set = mysqli_query($connection, $query);

	if($result_set){
		//query successful

		if(mysqli_num_rows($result_set) == 1){
			// valid user found
			$user = mysqli_fetch_assoc($result_set);
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['first_name'] = $user['first_name'];

			//updating last login
			$query = "UPDATE user SET last_login = NOW()";
			$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";

			$result_set = mysqli_query($connection, $query);

			if(!$result_set){
				die("Database query failed.");
			}

			// redirect to user.php
			header('Location: users.php');
		}else {
			//username and password invalid
			$errors[] = 'Invalid Username / Password';
		}
	}else{
		$errors[] = 'Database query failed.';
	}
	
	
	}
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In - User Management System</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="login">

		<form action="index.php" method="post">
			<fieldset>
				<legend><h1>Log In</h1></legend>

				<?php 
				if(isset($errors) && !empty($errors)){
					echo '<p class="error">Invalid Username / Password</p>';
				}

				?>

				<?php 
				if (isset($_GET['logout'])){
					echo '<p class="info">You Have successfully log out.</p>';
				}

				?>

				<p>
					<label for="">Username:</label>
					<input type="text" name="email" id="" placeholder="Email Address">
				</p>

				<p>
					<label for="">Password</label>
					<input type="password" name="password" id="" placeholder="Password">
				</p>

				<p>
					<button type="submit" name="submit"> Log in</button>
				</p>
			</fieldset>
		</form>

	</div>
</body>
</html>
<?php mysqli_close($connection) ?>