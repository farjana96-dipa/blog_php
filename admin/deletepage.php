<?php include 'inc/ad_header.php'; ?>
<?php include 'inc/ad_sidebar.php'; ?>
<?php
    if(!isset($_GET['delid']) || $_GET['delid']==NULL){
        header('Location:index.php');
    }
   
        $id = $_GET['delid'];

        $delquery = "DELETE FROM tbl_page WHERE id= '$id' ";
        $delres = $db->delete($delquery);
        if($delres){
            echo $delres;    
        }
        else{
             header('Location:index.php');
        }
?>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    <?php include 'inc/ad_footer.php'; ?>