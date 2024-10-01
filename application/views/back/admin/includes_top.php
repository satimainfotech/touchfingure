<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $system_title;?></title>
	<link href="<?php echo base_url(); ?>template/back/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/css/common.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/css/common_min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/animate-css/animate.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/morris-js/morris.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/switchery/switchery.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/chosen/chosen.min.css" rel="stylesheet">
	
	<script src="<?php echo base_url(); ?>template/back/admin/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo base_url(); ?>template/back/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>template/back/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<link href="<?php echo base_url(); ?>template/back/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/admin/css/jquery.fancybox.css" rel="stylesheet">
	
	<?php $ext =  $this->db->get_where('general_settings',array('type' => 'fav_ext'))->row()->value;?>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/others/favicon.<?php echo $ext; ?>">
</head>
