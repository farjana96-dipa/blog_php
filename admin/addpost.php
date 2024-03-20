<<?php include 'inc/ad_header.php'; ?>
    <?php include 'inc/ad_sidebar.php'; ?> 

    <?php

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block"> 
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
                            
                            move_uploaded_file($file_tmp,$folder);
                            //Image upload End


                            if(empty($title) || empty($body) || empty($author) || empty($tags) || empty($catid) || empty($file_name) || empty($userid)){
                                echo "<div style='color:red;'><strong>Field must not be empty!!</strong></div>";
                            }
                            else if($file_size > 1000000){
                                echo "<div style='color:red;'><strong>Image size should be less than 1MB.</strong></div>";
                            }
                            else if(in_array($file_ext,$permit)===false){
                                echo "<div style='color:red;'><strong>You can upload only".implode(',',$permit)."</strong></div>";
                            }
                            else{
                                $query = "INSERT INTO tbl_post(cat,title,body,image,author,tags,date,userid) 
                                          VALUES('$catid','$title','$body','$folder','$author','$tags','$date','$userid')";
                                $sql = $db->insert($query);
                                if($sql){
                                    echo $sql;
                                }
                                else{
                                    echo "<div style='color:red;'><strong>Post is not inserted !! Try again !</strong></div>";
                                }
                            }
                        }
                    ?>
                
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category Id</label>
                            </td>
                            <td>
                                <input type="number" name="cat" placeholder="Enter Post Category Id" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="name">
                                    <option>Select Category</option>
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
                                <input type="text" id="date-picker" name="date" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" ></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Post Tags" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author Name</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('username'); ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('id'); ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add Post" />
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