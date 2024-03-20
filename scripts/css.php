<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
<style>
.logo img {
    float: left;
    padding-bottom: 10px;
    padding-top: 10px;
    width: 80px;
  
}    
</style>

<?php
    $query = "SELECT *FROM tbl_theme WHERE id = '1' ";
    $res = $db->select($query);
    if($res){
    while($val = $res->fetch_assoc()){
        if($val['theme']=='default'){?>
            <link rel="stylesheet" href="theme/default.css">
        <?php } else if($val['theme']=='green') {?>
            <link rel="stylesheet" href="theme/green.css">
        <?php } else if($val['theme']=='paste') { ?>
            <link rel="stylesheet" href="theme/paste.css">
            <?php } } } ?>