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
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
    <?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link,$email);

				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					echo "<div style='color:red'><strong>Invalid Email Address !</strong></div>";
				}
                $query = "SELECT *FROM tbl_user WHERE email = '$email' LIMIT 1 ";
				$res = $db->select($query);
                if($res){
                    while($val = $res->fetch_assoc()){
                        $uid = $val['id'];
                        $uname = $val['username'];
                    }
                    $txt = substr($email,0,3);
                    $rnd = rand(10000,99999);
                    $newpass = "$txt$rnd";
                    $password = md5($newpass);

                    $to = '$email';
                    $from = "farjana96455@gmail.com";
                    $headers = "From : $frmo\n";
                    $headers .= 'MIME-Version : 1.0'."\r\n";
                    $headers .= "Content-type : text/html; charset=iso-8859-1". "\r\n";
                    $sub = "Your New Password\n";
                    $msg = "Your Username : ".$uname."\n Your password : ".$password."\n Please visit the website.";

                    $sendmail = mail($to,$sub,$msg,$headers);
                    if($sendmail){
                        echo "<div style='color:white;margin-bottom:15px;'><strong>Please check your email for new password. !!</strong></div>";
                    }
                    else{
                        echo "<div style='color:red;'><strong>Something went wrong !</strong></div>";
                    }
                }
                else{
                    echo "<div style='color:red;'><strong>Email not Exist !</strong></div>";
                }
                
			
			}
		?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			
			<div>
				<input type="text" placeholder="Enter valid email"  name="email"/>
			</div>
			<div>
				<input type="submit" value="Submit" name="submit" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>