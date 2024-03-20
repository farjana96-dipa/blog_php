<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
  
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $catname = mysqli_real_escape_string($db->link,$_POST['name']);
                        $catname = strtoupper($catname);
                        if(empty($catname)){
                            echo "<div style='color:red'><strong>Field must not be empty!</strong></div>";
                        }
                        $query = "INSERT INTO tbl_category(name) VALUES('$catname')";
                        $res = $db->insert($query);
                        if($res){
                            echo $res;
                        }
                        else{
                            echo "<div style='color:red'><strong>Category not inserted !! Try again !</strong></div>";
                        }

                    }
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name='name' placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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