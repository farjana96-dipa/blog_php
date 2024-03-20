<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
if(!isset($_GET['id']) OR $_GET['id']==NULL){
    header('Location:userlist.php');
}
else{
    $id = $_GET['id'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update User</h2>
               <div class="block copyblock"> 
               <?php
                  if($_SERVER['REQUEST_METHOD']=='POST'){
                    $uname = $fm->validation($_POST['username']);
                    $pass = $fm->validation($_POST['password']);
                    $email = $fm->validation($_POST['email']);
                    $details = $fm->validation($_POST['details']);
                   

                    $uname = mysqli_real_escape_string($db->link,$uname);
                    $pass = mysqli_real_escape_string($db->link,$pass);
                    $email = mysqli_real_escape_string($db->link,$email);
                    $details = mysqli_real_escape_string($db->link,$details);


                    $permit = array('jpg','jpeg','png','gif','webp','svg','avif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $explode = explode('.',$file_name);
                    $file_ext = strtolower(end($explode));
                    $unique_image = substr(md5(time()),0,8).'.'.$file_ext;
                    $folder = "upload/".$unique_image;
                    
                    if(empty($uname) || empty($pass) || empty($email) || empty($details)){
                        echo "<div style='color:red'><strong>Field must not be empty!</strong></div>";
                    }
                    else{
                        move_uploaded_file($file_tmp,$folder);
                        $query = "UPDATE tbl_user SET 
                                  username = '$uname',
                                  password = '$pass',
                                  email    = '$email',
                                  image    = '$folder',
                                  details  = '$details'
                                  WHERE id = '$id'";
                        $res = $db->update($query);
                        if($res){
                            echo $res;
                        }
                        else{
                            echo "<div style='color:red'><strong>User Profile not updated !</strong></div>";
                        }
                    }
                }
                ?>
                <?php
                    $query = "SELECT *FROM tbl_user WHERE id = '$id' ";
                    $res = $db->select($query);
                    if($res){
                    while($val = $res->fetch_assoc()){
                ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                       
                        <tr>
                            <td><label>Username</label></td>
                            <td>
                                <input type="text"  name='username' class="medium" value="<?php echo $val['username']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
                            <td>
                                <input type="text"  name='password' class="medium" value="<?php echo $val['password']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <input type="text"  name='email' class="medium" value="<?php echo $val['email']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Profile Pic</label>
                            </td>
                            <td>
                           
                                <input type="file" name="image" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"> 
                                    <?php echo $val['details']; ?>
                                </textarea>
                            </td>
                        </tr>
                       
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
   
<?php include 'inc/ad_footer.php'; ?>