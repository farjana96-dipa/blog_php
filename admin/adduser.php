<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
   $x = '0';
   $y = Session::get('role');
    if($x !== $y){
       // header('Location:index.php');
        echo "<script>window.location.href='index.php';</script>";
    }
    
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
              
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $username = $fm->validation($_POST['username']);
                        $password = $fm->validation($_POST['password']);
                        $email = $fm->validation($_POST['email']);
                        $details = $fm->validation($_POST['details']);
                        $role = $fm->validation($_POST['role']);


                        $username = mysqli_real_escape_string($db->link,$username);
                        $password = mysqli_real_escape_string($db->link,$password);
                        $email = mysqli_real_escape_string($db->link,$email);
                        $details = mysqli_real_escape_string($db->link,$details);
                        $role = mysqli_real_escape_string($db->link,$role);
                        
                        $password = md5($password);

                        if(empty($username) || empty($password) || empty($role) || empty($email) || empty($details)){
                            echo "<div style='color:red'><strong>Field must not be empty!</strong></div>";
                        }
                        else{
                            $mailquery = "SELECT *FROM tbl_user WHERE email = '$email' LIMIT 1";
                            $resmail = $db->select($mailquery);
                            if($resmail){
                                echo "<div style='color:red'><strong>This email is already exist !!</strong></div>";
                            }
                            else{
                                $query = "INSERT INTO tbl_user(username,password,email,details,role) VALUES('$username','$password','$email','$details','$role')";
                                $res = $db->insert($query);
                                if($res){
                                    echo $res;
                                }
                                else{
                                    echo "<div style='color:red'><strong>Category not inserted !! Try again !</strong></div>";
                                }
        
                            }
                        }
                       
                      
                    }
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td><label for="name">Username</label></td>
                            <td>
                                <input type="text" name='username' placeholder="Enter Your Username..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td>
                                <input type="text" name='password' placeholder="Enter Your Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td>
                                <input type="email" name='email' placeholder="Enter Your Email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details">
                                   
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="role">User Role</label></td>
                            <td>
                                <select name="role" id="">
                                    <option>Select User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Visitor</option>
                                    <option value="2">Editor</option>
                                    <option value="3">Author</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Create User" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
   
<?php include 'inc/ad_footer.php'; ?>