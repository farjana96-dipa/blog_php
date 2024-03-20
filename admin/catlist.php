<?php include 'inc/ad_header.php'; ?>

<?php include 'inc/ad_sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
				<!-- Delete Category -->
				<?php
					if(isset($_GET['deleteid'])){
						$catid = $_GET['deleteid'];
					}
					$query = "DELETE FROM tbl_category WHERE id = '$catid' ";
					$res = $db->delete($query);
					if($res){
					
				?>
                <h2>Category List</h2>
				<?php echo $res; } else{echo "<div style='color:red'><strong>Category is not deleted !</strong></div>";}?>
				<!-- Delete Category End-->
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- Select Category -->
						<?php 
							$query = "SELECT *FROM tbl_category ORDER BY id DESC";
							$res = $db->select($query);
							if($res){
								$i = 0;
								while($val = $res->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $val['name']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $val['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure delete it ?');" href="?deleteid=<?php echo $val['id']; ?>">Delete</a></td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
   

<?php include 'inc/ad_footer.php'; ?>
