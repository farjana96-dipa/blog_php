<?php include 'inc/ad_header.php'; ?>


<?php include 'inc/ad_sidebar.php'; ?>
<style>
 .delpage{
    margin-left:10px;
 }
 .delpage a{
    background:#ddd;
    color:#000;
    padding:5px 10px;
   
    font-size:18px;
 }
</style>

<?php
if(!isset($_GET['pageid']) OR ($_GET['pageid'])==NULL){
    header('Location:index.php');
}
else{
    $pid = $_GET['pageid'];
}
?>
   <?php  
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = mysqli_real_escape_string($db->link,$_POST['name']);
        $body = mysqli_real_escape_string($db->link,$_POST['body']);
        if(empty($name) || empty($body) ){
            echo "<div style='color:red;'><strong>Field must not be empty!!</strong></div>";
        }
        else{
            $query = "UPDATE tbl_page SET name = '$name' ,
             body = '$body' WHERE id = '$pid' ";
            $sql = $db->update($query);
            if($sql){
                echo $sql;
            }
            else{
                echo "<div style='color:red;'><strong>Page is not updated !! Try again !</strong></div>";
            }
        }
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Page</h2>
                <div class="block"> 
                   
                <?php  
                    $query = "SELECT *FROM tbl_page WHERE id = '$pid' ";
                    $page = $db->select($query);
                    if($page){
                        while($pares = $page->fetch_assoc()){
                ?>
                
                 <form action="" method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $pares['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                <?php echo $pares['body']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Page" />
                                <!--span class="delpage"><a onclick="return confirm('Do you want to delete it?')" href="deletepage.php?delid=<?php echo $pares['id']; ?>">Delete</a></span-->
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