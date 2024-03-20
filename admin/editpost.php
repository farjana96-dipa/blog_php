<?php include 'inc/ad_header.php'; ?>

<?php include 'inc/ad_sidebar.php'; ?>
<?php
    if(!isset($_GET['id']) || $_GET['id']==NULL){
        header('Location:postlist.php');
    }
    else{
        $id=$_GET['id'];
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Post</h2>
                <div class="block"> 
                    
                 <!--Update Post -->
                 <?php
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                            $title = mysqli_real_escape_string($db->link,$_POST['title']);
                            $body = mysqli_real_escape_string($db->link,$_POST['body']);
                            $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
                            $author = mysqli_real_escape_string($db->link,$_POST['author']);
                            $catid = mysqli_real_escape_string($db->link,$_POST['cat']);
                            $date = mysqli_real_escape_string($db->link,$_POST['date']);
                            $userid = mysqli_real_escape_string($db->link,$_POST['userid']);
                           

                            // Image upload
                            $permit = array('jpg','jpeg','png','gif','webp','svg','avif');
                            $file_name = $_FILES['image']['name'];
                            $file_size = $_FILES['image']['size'];
                            $file_tmp = $_FILES['image']['tmp_name'];
                            $explode = explode('.',$file_name);
                            $file_ext = strtolower(end($explode));
                            $unique_image = substr(md5(time()),0,8).'.'.$file_ext;
                            $folder = "upload/".$unique_image;
                            
                            
                            //Image upload End


                            if(empty($title) || empty($body) || empty($author) || empty($tags) || empty($catid)){
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
                                    $queryy = "UPDATE tbl_post SET title = '$title', body = '$body' , tags = '$tags',
                                    author = '$author', cat = '$catid', image = '$folder', date = '$date', userid = '$userid' WHERE id = '$id' ";
                                    $update_row = $db->update($queryy);
                                    if($update_row){
                                        echo $update_row;
                                    }
                                    else{
                                        echo "<div style='color:red;'><strong>Post is not Updated !! Try again !</strong></div>";
                                    }
                                }
                            }
                            else{
                                move_uploaded_file($file_tmp,$folder);
                                    $queryy = "UPDATE tbl_post SET title = '$title', body = '$body' , tags = '$tags',
                                    author = '$author', cat = '$catid', image = '$folder', date = '$date' , userid = '$userid' WHERE id = '$id' ";
                                    $update_row = $db->update($queryy);
                                    if($update_row){
                                        echo $update_row;
                                    }
                                    else{
                                        echo "<div style='color:red;'><strong>Post is not Updated !! Try again !</strong></div>";
                                    }
                            }
                        
                        }
                    ?>
                <!--Update post--> 
                

                <!--Display value in text field for update-->
                <?php
                        $query = "SELECT *FROM tbl_post WHERE id = '$id'";
						$select_val = $db->select($query);
                        if($select_val){
                            while($value = $select_val->fetch_assoc()){
                ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" value="<?php echo $value['title']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category Id</label>
                            </td>
                            <td>
                                <input type="number" name="cat" placeholder="Enter Post Category Id" class="medium" value="<?php echo $value['cat']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="name">
                                <?php 
                                        $query = "SELECT *FROM tbl_category ORDER BY id DESC";
                                        $res = $db->select($query);
                                        if($res){ 
                                            while($val = $res->fetch_assoc()){       
                                    ?>
                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" id="date-picker" name="date" value="<?php echo $value['date']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $value['image']; ?>" alt="" height="60px" width="100px"><br>
                                <input type="file" name="image" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $value['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Post Tags" class="medium" value="<?php echo $value['tags']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author Name</label>
                            </td>
                            <td>
                                <input type="text" name="author" class="medium" value="<?php echo $value['author']; ?>"/>
                                <input type="hidden" name="userid" value="<?php echo Session::get('id'); ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Post" />
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