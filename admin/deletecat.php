<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
  <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Delete Category</h2>
               <div class="block copyblock"> 
               
               
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text"  name='name' placeholder="Enter Category Name..." class="medium" value="<?php echo $val['name']; ?>"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Delete" />
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