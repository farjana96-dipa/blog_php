<?php include 'inc/header.php'; 
?>
	
<?php  include 'inc/slider.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
				$per_page = 3;
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}
				else{
					$page = 1;
				}
				$start_from = ($page - 1) * $per_page;
				
			?>
			<?php  
			$query = "SELECT *FROM tbl_post limit $start_from, $per_page";
			$post = $db->select($query);
			if($post){
				while($result = $post->fetch_assoc()){	
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>  By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
				<p>
				<?php echo $fm->textshorten($result['body'],180); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
			<?php } ?> <!--end while loop-->
			<!--Pagination-->
			<?php
				$query = "SELECT *FROM tbl_post";
				$post = $db->select($query);
				$total_rows = mysqli_num_rows($post);
				$total_pages = ceil($total_rows/$per_page);

				echo '<span class="pagination"><a href="index.php?page=1">First Page</a>';
			    
				for($i=1;$i<=$total_pages;$i++){
					echo "<a href='index.php?page=$i'>$i</a>";
				}

		
				echo "<a href='index.php?page=$total_pages'>Last Page</a></span>";
			?>
			<!--Pagination-->

			<?php } else { header('Location:404.php'); } ?> <!--end if condition-->

		</div>
		
		<?php include 'inc/sidebar.php'; ?>
     			
		<?php  include 'inc/footer.php'; ?>
