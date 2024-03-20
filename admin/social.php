<?php include 'inc/ad_header.php'; ?>

<?php include 'inc/ad_sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">  
                    <?php
                         if($_SERVER['REQUEST_METHOD']=='POST'){
                            $fb = $fm->validation($_POST['fb']);
                            $lnk = $fm->validation($_POST['lnk']);
                            $ins = $fm->validation($_POST['ins']);
                            $gp = $fm->validation($_POST['gp']);

                            $lnk = mysqli_real_escape_string($db->link,$_POST['lnk']);
                            $fb = mysqli_real_escape_string($db->link,$_POST['fb']);
                            $ins = mysqli_real_escape_string($db->link,$_POST['ins']);
                            $gp = mysqli_real_escape_string($db->link,$_POST['gp']);

                            


                            if(empty($fb) || empty($lnk) || empty($ins) || empty($gp) ){
                                echo "<div style='color:red;'><strong>Field must not be empty!!</strong></div>";
                            }
                            else{
                                
                                $query = "UPDATE tbl_social SET fb = '$fb', lnk = '$lnk' ,
                                           ins='$ins', gp='$gp' WHERE id = 1 ";
                                    $update_row = $db->update($query);
                                    if($update_row){
                                        echo $update_row;
                                    }
                                    else{
                                        echo "<div style='color:red;'><strong>Data is not Updated !! Try again !</strong></div>";
                                    }
                            } 
                        }
                    ?>
                   
                     <?php
                     $query = "SELECT *FROM tbl_social WHERE id = '1'";
                     $getdata = $db->select($query);
                     if($getdata){
                         while($res = $getdata->fetch_assoc()){   
                    ?>
                 <form action="" method="POST" >
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $res['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Instagram</label>
                            </td>
                            <td>
                                <input type="text" name="ins" value="<?php echo $res['ins']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="lnk" value="<?php echo $res['lnk']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $res['gp']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
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