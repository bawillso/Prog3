<?php
		session_start();
require "../Bwill/database.php";
		$errorMessage = $_GET['errorMessage'];
		
		
		if($_POST) {
		
		$success = false;
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		
		
		
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		//echo $username . ' ' . $password ; exit();
		
		
		
		$sql = "SELECT * FROM customer WHERE email = '$username' AND password_hash = '$password' LIMIT 1";
		
		$q = $pdo->prepare($sql);
		$q->execute(array());
		$data = $q->fetch(PDO::FETCH_ASSOC);
		//print_r ($data); exit();
	
		if($data){
			var_dump($data);
			$_SESSION['ASDjiadfj'] = $data['id'];
			$_SESSION["username"] = $username;
			header("Location: success.php ");
		}
		else{
			Database::disconnect();
			header("Location: login.php?errorMessage=Invalid");
			exit();
		
		}
		}
	
	// Else just show empty login form
  ?>
  
  <h1>Log In</h1>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset='UTF-8'>
                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
                <style>label {width: 5em;}</style>
				</head>
				
				
<body>
	<div class="container">
	<div class="span10 offset1">

		<div class="row">
			<h3> LOGIN </h3>
		</div>

<form class="form-horizontal" action="login.php" method="post">
				<p style='color: red;'><?php echo $errorMessage; ?></p>
				<input name="username" type="text" required>
				<input name="password" type="password" required>
				<button type="submit" class="btn btn-success">Sign in</button>
				<a href='join.php'> Join </a>
		</form>
</body>
</html>
