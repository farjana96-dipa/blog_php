<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<style>
    input[type="radio"]{
        border: 1px solid #000;
    }
</style>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php     
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                            $theme = mysqli_real_escape_string($db->link,$_POST['theme']);
                            
                           
                                $query = "UPDATE tbl_theme SET theme = '$theme' WHERE id = '1'";
                                $res = $db->update($query);
                                if($res){
                                    echo $res;
                                    
                                }
                                else{
                                    echo "<div style='color:red'><strong>Category is not updated !</strong></div>";
                                }
                            
                        }
                ?>
                <?php
                    $query = "SELECT *FROM tbl_theme WHERE id = '1' ";
                    $res = $db->select($query);
                    if($res){
                    while($val = $res->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <select name="theme" id="">
                                    <option value="">Select the theme color</option>
                                    <option value="default">Default</option>
                                    <option value="green">Green</option>
                                    <option value="paste">Paste</option>
                                </select>
                            </td>
                        </tr>					
                     
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
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