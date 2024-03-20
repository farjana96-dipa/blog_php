<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						
						<tr>
							<th width="5%">Serial No.</th>
							<th width="10%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Category ID</th>
							<th width="5%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="15%">Date</th>
							
							<th width="5%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category
									  ON tbl_post.cat = tbl_category.id 
									  ORDER BY tbl_post.id ";
							$sql = $db->select($query);
							if($sql){
								$i=0;
								while($res = $sql->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $res['title']; ?></td>
							<td><?php echo $fm->textshortenAd($res['body'],80); ?></td>
							<td><?php echo $res['name']; ?></td>
							<td class="center"><?php echo $res['cat']; ?></td>
							<td><img src="<?php echo $res['image']; ?>" height="50px" width="50px" alt=""></td>
							<td><?php echo $res['author']; ?></td>
							<td><?php echo $res['tags']; ?></td>
							<td><?php echo $fm->formatDate($res['date']); ?></td>
							
							<td>
							<a href="viewpost.php?id=<?php echo $res['id']; ?>">View</a>
							<?php
								if((Session::get('id')==$res['userid']) || Session::get('role')=='0'){ ?>
									 || 
									<a href="editpost.php?id=<?php echo $res['id']; ?>">Edit</a> ||
									<a href="deletepost.php?delid=<?php echo $res['id']; ?>" >Delete</a></td>
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