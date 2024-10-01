<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle" ><?php echo translate('Manage_roles');?></h1>
		<?php if($this->crud_model->admin_permission('staff_role_add')){?>
			<button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" onclick="ajax_set_full('add','<?php echo translate('add_role'); ?>','<?php echo translate('successfully_added!'); ?>','role_add',''); proceed('to_list');"><?php echo translate('create_role');?></button>
			<button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_role_list');?></button>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'staff/role';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	
	function proceed(type){
		if(type == 'to_list'){
			$(".pro_list_btn").show();
			$(".add_pro_btn").hide();
		} else if(type == 'to_add'){
			$(".add_pro_btn").show();
			$(".pro_list_btn").hide();
		}
	}
</script>
