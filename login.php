 <?php
		 
		require "../Prog3/database.php";
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
			$_SESSION["username"] = $username;
			header("Location: success.php ");
		}
		else{
			header("Location: login.php?errorMessage=Invalid");
			exit();
		
		}
		}
	
	// Else just show empty login form


  ?>
  
  <h1>Log In</h1>

<form class="form-horizontal" action="login.php" method="post">
				<p style='color: red;'><?php echo $errorMessage; ?></p>
				<input name="username" type="text" required>
				<input name="password" type="password" required>
				<button type="submit" class="btn btn-success">Sign in</button>
				<a href='logout.php'> Log Out </a>
				<a href='join.php'> Join </a>
		</form>