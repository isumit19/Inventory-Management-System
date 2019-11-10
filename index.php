<?php 
require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location: dashboard.php');	
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['userId'] = $user_id;

				header('location: dashboard.php');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username does not exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inventory Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css1/bootstrap.css">
    <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="custom/css/custom1.css">
	
</head>
    
    <body>
	
        <div id="home" class="home-bg" style="background-color: #000000;
background-image: linear-gradient(147deg, #000000 0%, #2c3e50 74%);">
                            
                    <div class="container">
                        <div class="row">
                        
                         
                         <div class="col-md-offset-3">
                            <div style="color:white;margin-top:80px">
                                <h1>INVENTORY MANAGEMENT SYSTEM</h1></div></div>
                        
                        </div>
            </div>
            
            
                <div class="container">
                    
                    <div class="row login-box">
                        
                        <div class="col-md-5 col-md-offset-4">
                        
                        
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                    Please Sign In
                                         
                                    </div>
                                </div>
                                
                                <div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-8 col-sm-5">
									  <button type="submit" class="btn btn-dark"> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
                                
                                
                            </div>
                        
                        </div>
                        
                    
                    </div>
                
                </div>
            
            </div>
            
        
        
        
        
    
        
        
        <script src="assets/js/bootstrap.min.js"></script>
	

    </body>
</html>







	