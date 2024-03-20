<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $note = mysqli_real_escape_string($db->link,$_POST['note']);
                        $note = $fm->validation($note);
                       
                        if(empty($note) ){
                            echo "<div style='color:red;'><strong>Field must not be empty!!</strong></div>";
                        }
                        else{
                            
                            $query = "UPDATE tbl_footer SET note='$note' WHERE id = '1' ";
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
                    $query = "SELECT *FROM tbl_footer WHERE id = '1' ";
                    $fot = $db->select($query);
                    if($fot){
                        while($fres = $fot->fetch_assoc()){
		
	                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text"  name="note" class="large" value="<?php echo $fres['note']; ?>"/>
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