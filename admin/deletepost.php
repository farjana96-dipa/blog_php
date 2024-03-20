<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
    if(!isset($_GET['delid']) || $_GET['delid']==NULL){
        header('Location:postlist.php');
    }
   
        $id=$_GET['delid'];
        $query = "SELECT *FROM tbl_post WHERE id = '$id' ";
        $data = $db->select($query);
        if($data){
            while($res = $data->fetch_assoc()){
               $delimg = $res['image'];
               unlink($delimg);  
            }
        }

        $delquery = "DELETE FROM tbl_post WHERE id= '$id' ";
        $delres = $db->delete($delquery);
        if($delres){
            echo $delres;
            
            
        }
        else{
          
             header('Location:postlist.php');
        }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						
						<tr>
							<th>Serial No.</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Image</th>
							<th>Author</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category
									  ON tbl_post.cat = tbl_category.id 
									  ORDER BY tbl_post.id DESC";
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
							<td><img src="<?php echo $res['image']; ?>" height="50px" width="50px" alt=""></td>
							<td><?php echo $res['author']; ?></td>
							<td><?php echo $res['tags']; ?></td>
							<td><?php echo $fm->formatDate($res['date']); ?></td>
							<td class="center"><?php echo $res['cat']; ?></td>
							<td><a href="editpost.php?id=<?php echo $res['id']; ?>">Edit</a> || <a onclick="return confirm('Do you want to delete it?')" href="postlist.php?delid=<?php echo $res['id']; ?>">Delete</a></td>
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
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    <?php include 'inc/ad_footer.php'; ?>