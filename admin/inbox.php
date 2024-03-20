<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php 
	if(isset($_GET['seenid'])){
		$seenid = $_GET['seenid'];

		$queryy = "UPDATE tbl_contact SET status = '1'  WHERE id = '$seenid' ";
		$update_row = $db->update($queryy);
		if($update_row){
			echo "<div style='color:white;margin-bottom:15px;'><strong>Message sent to the seen box !</strong></div>";
		}
		else{
			echo "<div style='color:red;'><strong>Something Wrong !!</strong></div>";
		}
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr class="odd gradex">
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
								$query = "SELECT *FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
								$user = $db->select($query);
								if($user){
									$i = 0;
									while($userinfo = $user->fetch_assoc()){
										$i++;
							?>
						<tr class="odd gradeX">
							
							<td><?php echo $i; ?></td>
							<td><?php echo $userinfo['firstname']. ' ' . $userinfo['lastname']; ?></td>
							<td><?php echo $userinfo['email']; ?></td>
							<td><?php echo $fm->textshortenAd($userinfo['body'],50); ?></td>
							<td><?php echo $fm->formatDate($userinfo['date']); ?></td>
							
							<td>
								<a href="viewmsg.php?msgid=<?php echo $userinfo['id']; ?>">View</a> || 
								<a href="replymsg.php?msgid=<?php echo $userinfo['id']; ?>">Reply</a> ||
								<a onclick="return confirm('Are you sure to move it?');" href="?seenid=<?php echo $userinfo['id']; ?>">Seen</a>
						</td>
						
						</tr>
						<?php } } ?>
						<!--tr class="even gradeC">
							<td>02</td>
							<td>Explorer </td>
							<td><a href="">Edit</a> || <a href="">Delete</a></td>
						</tr-->
						
					</tbody>
				</table>
               </div>
            </div>

			<!--Seen Message box-->
			<div class="box round first grid">
                <h2>Seen Message</h2>
				<?php
					if(isset($_GET['delid'])){
						$delid = $_GET['delid'];
						$queryy = "DELETE FROM tbl_contact WHERE id = '$delid' ";
						$delete_row = $db->delete($queryy);
						if($delete_row){
							echo "<div style='color:red;margin-bottom:15px;'><strong>Message is Deleted!!</strong></div>";
						}
						else{
							echo "<div style='color:red;'><strong>Something Wrong !!</strong></div>";
						}
					}
				?>
				<?php
					if(isset($_GET['unseenid'])){
						$uid = $_GET['unseenid'];
						$queryy = "UPDATE tbl_contact SET status = '0' WHERE id = '$uid' ";
						$update_row = $db->delete($queryy);
						if($update_row){
							echo "<div style='color:red;margin-bottom:15px;'><strong>Message Sent Inbox !!</strong></div>";
						}
						else{
							echo "<div style='color:red;'><strong>Something Wrong !!</strong></div>";
						}

					}
				?>
                <div class="block">        
				<table class="data display datatable" id="example">
					<thead>
						<tr class="odd gradex">
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
								$query = "SELECT *FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
								$user = $db->select($query);
								if($user){
									$i = 0;
									while($userinfo = $user->fetch_assoc()){
										$i++;
							?>
						<tr class="odd gradeX">
							
							<td><?php echo $i; ?></td>
							<td><?php echo $userinfo['firstname']. ' ' . $userinfo['lastname']; ?></td>
							<td><?php echo $userinfo['email']; ?></td>
							<td><?php echo $fm->textshortenAd($userinfo['body'],50); ?></td>
							<td><?php echo $fm->formatDate($userinfo['date']); ?></td>
							
							<td>
							<a href="viewmsg.php?msgid=<?php echo $userinfo['id']; ?>">View</a> ||
								<a href="?delid=<?php echo $userinfo['id']; ?>">Delete</a> ||
								<a href="?unseenid=<?php echo $userinfo['id']; ?>">Unseen</a>  
								
						</td>
						
						</tr>
						<?php } } ?>
						<!--tr class="even gradeC">
							<td>02</td>
							<td>Explorer </td>
							<td><a href="">Edit</a> || <a href="">Delete</a></td>
						</tr-->
						
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