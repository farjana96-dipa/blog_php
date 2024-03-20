<?php include 'inc/ad_header.php'; ?>

<?php include 'inc/ad_sidebar.php'; ?>
<?php
    if(!isset($_GET['msgid']) || $_GET['msgid']==NULL){
        header('Location:inbox.php');
    }
    else{
        $msgid=$_GET['msgid'];
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Messages</h2>
                
                <div class="block"> 
                
                
                 <form action="inbox.php" method="post" >
                 <?php
                       $query = "SELECT *FROM tbl_contact WHERE id = '$msgid'";
                       $select_val = $db->select($query);
                       if($select_val){
                           while($value = $select_val->fetch_assoc()){
                    ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="firstname"  class="medium" value="<?php echo $value['firstname']; ?>"  readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email"  class="medium" value="<?php echo $value['email']; ?>"  readonly/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" name="date"  class="medium" value="<?php echo $value['date']; ?>" readonly/>
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                <?php echo $value['body']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK"/>
                            </td>
                        </tr>
                    </table>
                    <?php } } ?>
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