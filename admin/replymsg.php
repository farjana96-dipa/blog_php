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
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $to = $fm->validation($_POST['toEmail']);
                        $from = $fm->validation($_POST['fromEmail']);
                        $sub = $fm->validation($_POST['sub']);
                        $msg = $fm->validation($_POST['body']);

                        $sendmail = mail($to,$sub,$msg,$from);
                        if($sendmail){
                            echo "<div style='color:white;margin-bottom:15px;'><strong>Message Sent Successfully !!</strong></div>";
                        }
                        else{
                            echo "<div style='color:red;'><strong>Something went wrong !</strong></div>";
                        }
                    }
                ?>
                <div class="block"> 
                
                
                 <form action="" method="post" >
                 <?php
                       $query = "SELECT *FROM tbl_contact WHERE id = '$msgid'";
                       $select_val = $db->select($query);
                       if($select_val){
                           while($value = $select_val->fetch_assoc()){
                    ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="toEmail"  class="medium" value="<?php echo $value['email']; ?>"  readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="email" name="fromEmail"  class="medium" placeholder="Enter your email address"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="sub"  class="medium" placeholder="Enter your subject"/>
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                
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