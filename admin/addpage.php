<?php include 'inc/ad_header.php'; ?>

<?php include 'inc/ad_sidebar.php'; ?>
<?php

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <div class="block"> 
                <?php
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                            $name = mysqli_real_escape_string($db->link,$_POST['name']);
                            $body = mysqli_real_escape_string($db->link,$_POST['body']);
                            if(empty($name) || empty($body) ){
                                echo "<div style='color:red;'><strong>Field must not be empty!!</strong></div>";
                            }
                            else{
                                $query = "INSERT INTO tbl_page(name,body) 
                                          VALUES('$name','$body')";
                                $sql = $db->insert($query);
                                if($sql){
                                    echo $sql;
                                }
                                else{
                                    echo "<div style='color:red;'><strong>Page is not created !! Try again !</strong></div>";
                                }
                            }
                        }
                    ?>
                
                 <form action="addpage.php" method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Page Name" class="medium" />
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
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add Page" />
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