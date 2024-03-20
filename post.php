<?php include 'inc/header.php'; 
	  
?>
<?php
	if(!isset($_GET['id']) OR $_GET['id'] == NULL){
		header('Location:404.php');
	}
	else{
		$id = $_GET['id'];
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
				$query = "SELECT *FROM tbl_post WHERE id = $id";
				$post = $db->select($query);
				if($post){
					
					while($result = $post->fetch_assoc()){	
			?>
			<div class="about">
				
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <?php echo $result['author']; ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<p><?php echo $result['body']; ?></p>
				<?php } ?> 
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$query = "SELECT *FROM tbl_post WHERE id = $id";
						$post = $db->select($query);
						$res = $post->fetch_assoc();
						$catid = $res['cat'];
						$query = "SELECT *FROM tbl_post WHERE cat = '$catid' order by rand() limit 6";
						$rel_post = $db->select($query);
						if($rel_post){
						while($rel_res = $rel_post->fetch_assoc()){	
					?>
					<a href="post.php?id=<?php echo $rel_res['id']; ?>">
					<img src="admin/<?php echo $rel_res['image']; ?>" alt="post image"/>
					
					</a>
					
					
					<?php } } else{
						echo "<h3>No related post is here..</h3>";
					} ?>
				</div>
				<?php } else{header('Location:404.php');} ?>
			</div>

		</div>
		<?php include 'inc/sidebar.php'; ?>
	</div>

	<?php include 'inc/footer.php'; ?>