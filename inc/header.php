<?php
include 'config/config.php';
include 'lib/Database.php';
include 'helpers/format.php';
$db = new Database();
$fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'scripts/meta.php'; ?>
	<?php include 'scripts/css.php'; ?>
	<?php include 'scripts/js.php'; ?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<?php
				$query = "SELECT *FROM title_slogan WHERE id = '1' ";
				$getdata = $db->select($query);
				if($getdata){
					while($getval = $getdata->fetch_assoc()){
			?>
			<div class="logo">
				<img src="admin/<?php echo $getval['logo']; ?>" alt="Logo"/>
				<h2><?php echo $getval['title']; ?></h2>
				<p><?php echo $getval['slogan']; ?></p>
			</div>
			<?php } } ?>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php
					$query = "SELECT *FROM tbl_social WHERE id = '1' ";
					$social = $db->select($query);
					if($social){
						while($soval = $social->fetch_assoc()){
					
				?>
				<a href="<?php echo $soval['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $soval['ins']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $soval['lnk']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $soval['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="post">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<?php 
		 $path = $_SERVER['SCRIPT_FILENAME'];
		 $curpage = basename($path,'.php');
		 ?>
		<li><a <?php if($curpage=='index'){echo 'id="active"';} ?> href="index.php">Home</a></li>
		<?php  
			$query = "SELECT *FROM tbl_page";
			$page = $db->select($query);
			if($page){
				while($pares = $page->fetch_assoc()){
			
		?>
		<li><a 
		<?php if(isset($_GET['pageid']) && $_GET['pageid']==$pares['id']){
			echo 'id="active"';
		} ?> 
		href="page.php?pageid=<?php echo $pares['id']; ?>"><?php echo $pares['name']; ?></a></li>
		<?php } } ?>
				<li><a <?php if($curpage=='contact'){echo 'id="active"';} ?> href="contact.php">Contact</a></li>
	</ul>
</div>