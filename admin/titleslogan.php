<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<style>
    .left-side{
        float:left;
        width:70%;
    }
    .right-side{
        float:left:
        width:20%;
    }
    .right-side img{
        height:150px;
        width:150px;
    }
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock ">
                    <div class="left-side">   
                    <?php
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                            $title = mysqli_real_escape_string($db->link,$_POST['title']);
                            $slogan = mysqli_real_escape_string($db->link,$_POST['slogan']);

                            $title = $fm->validation($title);
                            $slogan = $fm->validation($slogan);
                            
                            
                           

                            // Image upload
                            $permit = array('jpg','jpeg','png','gif','webp','svg','avif');
                            $file_name = $_FILES['logo']['name'];
                            $file_size = $_FILES['logo']['size'];
                            $file_tmp = $_FILES['logo']['tmp_name'];
                            $explode = explode('.',$file_name);
                            $file_ext = strtolower(end($explode));
                            $unique_image = substr(md5(time()),0,8).'.'.$file_ext;
                            $folder = "upload/".$unique_image;
                            
                            
                            //Image upload End


                            if(empty($title) || empty($slogan) ){
                                echo "<div style='color:red;'><strong>Field must not be empty!!</strong></div>";
                            } 
                            if(!empty($file_name)){
                                if($file_size > 1000000){
                                    echo "<div style='color:red;'><strong>Image size should be less than 1MB.</strong></div>";
                                }
                                else if(in_array($file_ext,$permit)===false){
                                    echo "<div style='color:red;'><strong>You can upload only".implode(',',$permit)."</strong></div>";
                                }
                                else{
                                    move_uploaded_file($file_tmp,$folder);
                                    $queryy = "UPDATE title_slogan SET title = '$title', slogan = '$slogan', logo = '$folder' WHERE id = '1' ";
                                    $update_row = $db->update($queryy);
                                    if($update_row){
                                        echo $update_row;
                                    }
                                    else{
                                        echo "<div style='color:red;'><strong>Data is not Updated !! Try again !</strong></div>";
                                    }
                                }
                            }
                            else{
                                move_uploaded_file($file_tmp,$folder);
                                    $queryy = "UPDATE title_slogan SET title = '$title', slogan = '$slogan',logo='$folder' WHERE id = '1' ";
                                    $update_row = $db->update($queryy);
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
                            $query = "SELECT *FROM title_slogan WHERE id = '1'";
                            $getdata = $db->select($query);
                            if($getdata){
                                while($res = $getdata->fetch_assoc()){

                        ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $res['title'] ?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $res['slogan'] ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Website Logo</label>
                            </td>
                            <td>
                                <img src="<?php echo $res['logo']; ?>" height="50px" width="70px" alt=""><br>
                                <input type="file" name="logo" class="medium"/>
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                    </div> 
                    <div class="right-side">
                    <img src="<?php  ?>" alt="">logologo
                     </div> 
                </div>
                
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
<?php include 'inc/ad_footer.php'; ?>
