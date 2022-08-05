<?php session_start(); ?>
<?php require_once ('inc/connection.php'); ?>
<?php require_once ('inc/functions.php'); ?>
<?php 

	//cheking if a user is logged in 
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');
	}

	$errors = array();

	$first_name = '';
	$last_name = '';
	$email = '';
	$password = '';

	if(isset($_POST['submit'])){

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];


		//cheking required feild

		$req_fields = array('first_name', 'last_name', 'email', 'password');

		foreach($req_fields as $field){
			if(empty(trim($_POST[$field]))){
			$errors[]= $field .' is required';
			}

		}

		//cheking max length

		$max_len_fields = array('first_name' => 50, 'last_name' => 50, 'email' => 50, 'password' => 50);

		foreach($max_len_fields as $field => $max_len){
			if(strlen(trim($_POST[$field])) >$max_len){
			$errors[]= $field .' must be less than' . $max_len . ' characters';
			}

		}

		// cheking email address already exists
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1 ";

		$result_set = mysqli_query($connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				$errors[]= 'Email address already exisits';

			}
		}

		if(empty($errors)){
			// no errors found. adding new record
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);

			$hashed_password = sha1($password);

			$query = "INSERT INTO user (";
			$query .= "first_name, last_name, email, password, is_deleted";
			$query .= ") VALUES (";
			$query .= "'{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}' , 0";
			$query .= ")";

			$result = mysqli_query($connection, $query);

			if($result)	{
				// query successful. redirect to user page
				header('Location: users.php?user_added=true');
			} else{
				$errors[] = 'Failed t oadd the new record.';
			}
		}

	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add New User</title>
	<link rel="stylesheet" href="css/main.css">

</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?> <a href="logout.php">Log out </a> </div>

	</header>

	<main>
		<h1>Add New User <span><a href="users.php">< Back to user list </a></span>  </h1>

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

		<form action="add-user.php" method="post" class="userform">
			
			<p>
				<label for="">First Name:</label>
				<input type="text" name="first_name" <?php echo 'value="' .$first_name . '"'; ?> >
			</p>

			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" <?php echo 'value="' .$last_name . '"'; ?> >
			</p>

			<p>
				<label for="">Email:</label>
				<input type="email" name="email" <?php echo 'value="' .$email . '"'; ?> >
			</p>

			<p>
				<label for="">Password</label>
				<input type="password" name="password" >
			</p>

			<p>
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Save</button>
			
			</p>



		</form>



	</main>



</body>
</html>