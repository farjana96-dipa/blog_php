<?php
		if(isset($_GET['pageid'])){
			$titleid = $_GET['pageid'];
			$query = "SELECT *FROM tbl_page WHERE id = '$titleid' ";
			$titleres = $db->select($query);
			if($titleres){
				while($titlename = $titleres->fetch_assoc()){ ?>
				<title><?php echo $titlename['name']; ?>-<?php echo TITLE;  ?></title>
					
	<?php } }  }else if(isset($_GET['id'])){ ?>
		<?php
		$titleid = $_GET['id'];
			$query = "SELECT *FROM tbl_post WHERE id = '$titleid' ";
			$titleres = $db->select($query);
			if($titleres){
				while($titlename = $titleres->fetch_assoc()){ ?>
				<title><?php echo $titlename['tags']; ?>-<?php echo TITLE;  ?></title>
				<?php } } } else{?>
					<title><?php echo $fm->title(); ?>-<?php echo TITLE;  ?></title>
	<?php }  ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
	 	if(isset($_GET['id'])){
			$metaid = $_GET['id'];
			$query = "SELECT *FROM tbl_post WHERE id = '$metaid' ";
			$meta = $db->select($query);
			if($meta){
				while($mres = $meta->fetch_assoc()){ ?>
				<meta name="keywords" content="<?php echo $mres['tags']; ?>">
				
				<?php } } } else{?>
					<meta name="keywords" content="<?php echo KEYWORDS; ?>">
					
	<?php }  ?>
	<!--meta name="keywords" content="blog,cms blog"-->
    <meta name="author" content="Farjana Dipa">