<?php
	$system_name	 =  $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
	$system_title	 =  $this->db->get_where('general_settings',array('type' => 'system_title'))->row()->value;
?>
<?php include 'includes_top.php'; ?>
<body class="<?php echo $page_name_link; ?>_page">
	<div id="container" class="effect mainnav-lg">
		<?php include 'header.php'; ?>
		<div class="boxed" id="fol">
			<div>
			<?php include $page_name.'.php' ?>
			</div>
			<?php include 'navigation.php' ?>
		</div>
		<?php include 'footer.php'; ?>
		<?php include 'script_texts.php'; ?>
	</div>
<?php include 'includes_bottom.php'; ?>

