<?php include 'inc/header.php'; ?>
<?php
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$fname = $fm->validation($_POST['firstname']);
			$fname = mysqli_real_escape_string($db->link,$fname);

			$lname = $fm->validation($_POST['lastname']);
			$lname = mysqli_real_escape_string($db->link,$lname);

			$email = $fm->validation($_POST['email']);
			$email = mysqli_real_escape_string($db->link,$email);

			$body = $fm->validation($_POST['body']);
			$body = mysqli_real_escape_string($db->link,$body);

			$error = "";
			$msg = "";

			if(empty($fname) || empty($lname) || (!filter_var($email,FILTER_VALIDATE_EMAIL)) || empty($body)){
				$error = "<div style='color:red;'>Field must not be empty!!</div>";
			}
			else{
				$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$fname','$lname','$email','$body')";
				$insertrow = $db->insert($query);
				if($insertrow){
					$msg = "<div style='color:green;'>Message Sent Successfully!!</div>";
				}
				else{
					$msg = "<div style='color:green;'>Message Not Sent!!!</div>";
				}
			}
			
			
		}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if(isset($error)){
						echo $error;
					}
					if(isset($msg)){
						echo $msg;
					}
				?>
				<form action="" method="post">
					<table>
						<tr>
							<td>Your First Name:</td>
							<td>
							<input type="text" name="firstname" placeholder="Enter first name" />
							</td>
							</tr>
						<tr>
							<td>Your Last Name:</td>
							<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
							</td>
						</tr>
							
						<tr>
							<td>Your Email Address:</td>
							<td>
							<input type="email" name="email" placeholder="Enter Email Address" />
							</td>
						</tr>
						<tr>
							<td>Your Message:</td>
							<td>
							<textarea name="body"></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
							<input type="submit" name="submit" value="Submit"/>
							</td>
						</tr>
					</table>
				<form>				
 		</div>

	</div>
		<?php include 'inc/sidebar.php'; ?>
	</div>

	<?php include 'inc/footer.php'; ?>