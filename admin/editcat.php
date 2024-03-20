<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
if(!isset($_GET['catid']) OR $_GET['catid']==NULL){
    header('Location:catlist.php');
}
else{
    $catid = $_GET['catid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php     
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                            $catname = mysqli_real_escape_string($db->link,$_POST['name']);
                            $catname = strtoupper($catname);
                            if(empty($catname)){
                                echo "<div style='color:red'><strong>Field must not be empty!</strong></div>";
                            }
                            else{
                                $query = "UPDATE tbl_category SET name = '$catname' WHERE id = '$catid'";
                                $res = $db->update($query);
                                if($res){
                                    echo $res;
                                    
                                }
                                else{
                                    echo "<div style='color:red'><strong>Category is not updated !</strong></div>";
                                }
                            }
                        }
                ?>
                <?php
                    $query = "SELECT *FROM tbl_category WHERE id = '$catid' ORDER BY id DESC";
                    $res = $db->select($query);
                    if($res){
                    while($val = $res->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text"  name='name' placeholder="Enter Category Name..." class="medium" value="<?php echo $val['name']; ?>"/>
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