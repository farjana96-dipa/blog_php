<?php
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/format.php';
$db = new Database();
$fm = new Format();
?>
<?php 
include '../lib/Session.php';

Session::checkLogin();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$name = $fm->validation($_POST['username']);
				$pass = $fm->validation(md5($_POST['password']));

				$name = mysqli_real_escape_string($db->link,$name);
				$pass = mysqli_real_escape_string($db->link,$pass);
			

				if(empty($name) || empty($pass)){
					echo "<div style='color:red'><strong>Field must not be empty!</strong></div>";
				}
				
				
				$query = "SELECT *FROM tbl_user WHERE username = '$name' AND password = '$pass' ";
				
				$res = $db->select($query);
				if($res){

					$val = $res->fetch_assoc();
					
						Session::init();
						Session::set('login',true);
						Session::set('username',$val['username']);
						Session::set('password',$val['password']);
						Session::set('id',$val['id']);
						Session::set('role',$val['role']);
						header('Location:index.php');	
				}
				else{
					echo '<span style="color:red;font-size:20px;">Username or Password Not Matched !</span>';
				}
			}
		?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" name="submit" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpass.php">Forget Password</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>