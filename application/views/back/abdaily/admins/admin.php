<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_staffs');?></h1>
		<?php if($this->crud_model->admin_permission('staff_add')){?>
			<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right custombutton" onclick="ajax_modal('add','<?php echo translate('add_staff');?>','<?php echo translate('successfully_added!');?>','admin_add','')" > <?php echo translate('create_admin');?></button>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'staff/admins';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
</script>
