<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: home.php');
		exit;
	
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}

}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>

	
<div class="container">

  <div class="login-page">

	<div class="row">

	 <div class="logo"><center><h1><span style="color:white"> You<span style="color:#188fff">Save </h1> </center></span></div>
      <center> <h3><span style="color:white">The best place to save your favorite youtube videos!</span></h3> </center>

	    <!-- <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"> -->
			<form role="form" method="post" action="" autocomplete="off">
				<center> <h4><span style="color:white">Please Login</span></h4></center>
				<center> <p> <span style="color:white">Don't have an account?</span> <a href='./'>Join now!</a></p></center>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						 <center> <a href='reset.php'>Forgot your Password?</a></center>
					</div>
				</div>
				<br>
				
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		<!-- </div> -->
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
