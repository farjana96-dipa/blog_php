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
                    $query = "SELECT *FROM tbl_user WHERE id = '$id' ";
                    $res = $db->select($query);
                    if($res){
                    while($val = $res->fetch_assoc()){
                ?>
                 <form action="userlist.php" method="post" enctype="multipart/form-data">
                    <table class="form">					
                       
                        <tr>
                            <td><label>Username</label></td>
                            <td>
                                <input type="text"  name='username' class="medium" value="<?php echo $val['username']; ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
                            <td>
                                <input type="text"  name='password' class="medium" value="<?php echo $val['password']; ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <input type="text" readonly name='email' class="medium" value="<?php echo $val['email']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Profile Pic</label>
                            </td>
                            <td>
                                <img src="<?php echo $val['image']; ?>" alt="">
                               
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details" readonly> 
                                    <?php echo $val['details']; ?>
                                </textarea>
                            </td>
                        </tr>
                       
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
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