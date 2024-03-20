

<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
				
					<ul>
					<?php
					$query = "SELECT *FROM tbl_category";
					$cat = $db->select($query);
					if($cat){
						while($result = $cat->fetch_assoc()){	
					?>
						<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>

					<?php } }  else{ ?> 
						<li>No Category Created.</li>
					<?php } ?>						
					</ul>
				
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>

					<div class="popular clear">
						<?php
							$query = "SELECT *FROM tbl_post ORDER BY id DESC limit 4";
							$latest_post = $db->select($query);
							if($latest_post){
								while($result = $latest_post->fetch_assoc()){
							
						?>
						<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
						<p><?php echo $fm->textShorten($result['body'],80); ?></p>	
						<?php } } else { echo "<p>No Post Created Yet!</p>"; } ?>
					</div>
			</div>
			
		</div>
	</div>

	