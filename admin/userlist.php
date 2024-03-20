<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
    if(isset($_GET['delid'])){
        $delid = $_GET['delid'];
        $delquery = "DELETE FROM tbl_user WHERE id= '$delid' ";
        $delres = $db->delete($delquery);
        if($delres){
            echo $delres;    
        }
        else{
             header('Location:index.php');
        }
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						
						<tr>
							<th width="5%">Serial No.</th>
							<th width="10%">Username</th>
                            <th width="10%">Email</th>
							<th width="5%">Image</th>
							<th width="10%">Details</th>
							<th width="10%">Role</th>
							<th width="5%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = "SELECT *FROM tbl_user ORDER BY id DESC ";
							$sql = $db->select($query);
							if($sql){
								$i=0;
								while($res = $sql->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $res['username']; ?></td>
							<td><?php echo $res['email']; ?></td>
							<td><img src="<?php echo $res['image']; ?>" height="50px" width="50px" alt=""></td>
                            <td>   
                                <?php echo $fm->textshortenAd($res['details'],80); ?>
                            </td>
							<td>
                                <?php
                                    if($res['role']==0){
                                        echo "Admin";
                                    }else if($res['role']==1){
                                        echo "Visitor";
                                    }
                                    else if($res['role']==2){
                                        echo "Editor";
                                    }
                                    else if($res['role']==3){
                                        echo "Author";
                                    }
                                ?>
                            </td>
							
							
							<td><a href="viewuser.php?id=<?php echo $res['id']; ?>">View</a>
                            <?php if(Session::get('role')==='0'){ ?> ||
                                <a href="edituser.php?id=<?php echo $res['id']; ?>">Edit</a> ||
							<a href="?delid=<?php echo $res['id']; ?>" onclick="return confirm('Are you sure delete this?');" >Delete</a></td>
                            <?php } ?>
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