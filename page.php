<?php include 'inc/header.php'; ?>
<?php
if(!isset($_GET['pageid']) OR $_GET['pageid']==NULL){
    header('Location:404.php');
}
else{
    $pageid = $_GET['pageid'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
            <?php  
			$query = "SELECT *FROM tbl_page where id = $pageid ";
			$post = $db->select($query);
			if($post){
				while($result = $post->fetch_assoc()){	
			?>
            <div class="samepost clear">
            <h2><a href="page.php?id=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></h2>
				
				<p>
				<?php echo $result['body']; ?>
				</p>
				
		    </div>
            <?php } } else{header('Location:404.php');} ?> <!--end if condition-->

        </div>    


<?php include 'inc/sidebar.php'; ?>

<?php  include 'inc/footer.php'; ?>        