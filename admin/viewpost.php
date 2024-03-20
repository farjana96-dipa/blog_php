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
                                <input type="text" name="title" class="medium" value="<?php echo $value['title']; ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category Id</label>
                            </td>
                            <td>
                                <input type="number" name="cat" class="medium" value="<?php echo $value['cat']; ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="name" readonly>
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
                                <input type="text" id="date-picker" name="date" value="<?php echo $value['date']; ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $value['image']; ?>" alt="" height="60px" width="100px"><br>
                              
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" readonly>
                                    <?php echo $value['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags"  class="medium" value="<?php echo $value['tags']; ?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author Name</label>
                            </td>
                            <td>
                                <input type="text" name="author" class="medium" value="<?php echo $value['author']; ?>" readonly/>
                                
                            </td>
                        </tr>
						<tr>
                            <td></td>
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