<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_why_convart');?></h1>
		<?php if($this->crud_model->admin_permission('our_technology_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/manage_website/our_technology_add"><?php echo translate('create_why_convart');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('No.');?></th>
										<th><?php echo translate('image');?></th>
										<th><?php echo translate('status');?></th>
										<th><?php echo translate('position');?></th>
										<?php if($this->crud_model->admin_permission('our_technology_view') || $this->crud_model->admin_permission('our_technology_status')|| $this->crud_model->admin_permission('our_technology_delete')|| $this->crud_model->admin_permission('our_technology_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_our_technology)){
									$i = $page_id+1;
									foreach($all_our_technology as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									<td>
									<img class="img-md"  src="<?php echo base_url();  ?>uploads/our_technology_image/<?php echo $row['our_technology_image']; ?>"  style="width:120px;"/>
									</td>
									<td>
										<input id="slide_<?php echo $row['our_technology_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['our_technology_id']; ?>" <?php if($row['our_technology_status']=='yes'){ echo 'checked'; } ?> />
									</td>
									<td class="table_input_field">
										<input type="text" name="p_our_technology_<?php echo $row['our_technology_id']; ?>" id="p_our_technology_<?php echo $row['our_technology_id']; ?>" value="<?php if($row['position'] != ''){ echo $row['position']; }else{ echo '0'; }?>"><span class="set_button" id="set_button_<?php echo $row['our_technology_id']; ?>" onclick="set_our_technology_position('<?php echo $row['our_technology_id']; ?>');"><i class="fa fa-check"></i>  Set</span>
									</td>
									<?php if($this->crud_model->admin_permission('our_technology_view') || $this->crud_model->admin_permission('our_technology_status')|| $this->crud_model->admin_permission('our_technology_delete')|| $this->crud_model->admin_permission('our_technology_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('our_technology_view')){ ?>
												<a href="<?php echo base_url(); ?>admin/manage_website/our_technology_view?s_t=<?php echo $row['our_technology_token']; ?>&s_i=<?php echo $row['our_technology_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('our_technology_edit')){ ?>
												<a href="<?php echo base_url(); ?>admin/manage_website/our_technology_edit?s_t=<?php echo $row['our_technology_token']; ?>&s_i=<?php echo $row['our_technology_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="Edit" data-container="body"><?php echo translate('edit');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('our_technology_edit')){ ?>
												<a onclick="delete_popup('<?php echo $row['our_technology_id']; ?>','<?php echo translate('really_wanf_to_delete_this_our_technology ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
											<?php } ?>
										</td>
									<?php } ?>
									
								</tr>
								<?php
									}
								}else{ ?>
									<tr style="text-align:center;">
										<td colspan="9">Data Not Found....</td>
									</tr>	
								<?php } ?>
								</tbody>
							</table>
						</div>
						<?php echo $links; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="vendr"></div>
<script>
var base_url = '<?php echo base_url(); ?>'
var user_type = 'admin';
var module = 'manage_website/our_technologys';
var delete_function = 'delete';
$(document).ready(function(){
	set_switchery();
});
function set_switchery(){
	$(".slide").each(function(){
		new Switchery(document.getElementById('slide_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
		var changeCheckbox = document.querySelector('#slide_'+$(this).data('id'));
		changeCheckbox.onchange = function() {
		  ajax_load(base_url+'index.php/'+user_type+'/'+module+'/status_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'','');
		  if(changeCheckbox.checked == true){
			$.activeitNoty({
				type: 'success',
				icon : 'fa fa-check',
				message : ppus,
				container : 'floating',
				timer : 3000
			});
			
		  } else {
			$.activeitNoty({
				type: 'danger',
				icon : 'fa fa-check',
				message : pups,
				container : 'floating',
				timer : 3000
			});
			
		  }
		};
	});
	
	$(".slides").each(function(){
		new Switchery(document.getElementById('slides_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
		var changeCheckbox = document.querySelector('#slides_'+$(this).data('id'));
		changeCheckbox.onchange = function() {
		  ajax_load(base_url+'index.php/'+user_type+'/'+module+'/show_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'','');
		  if(changeCheckbox.checked == true){
			$.activeitNoty({
				type: 'success',
				icon : 'fa fa-check',
				message : ppus,
				container : 'floating',
				timer : 3000
			});
			
		  } else {
			$.activeitNoty({
				type: 'danger',
				icon : 'fa fa-check',
				message : pups,
				container : 'floating',
				timer : 3000
			});
			
		  }
		};
	});
}
function set_our_technology_position(our_technology_id){
	var position_value = $('#p_our_technology_'+our_technology_id).val();
	var base_url = $('#base_url').val();
	if(position_value == ''){
		alert('Enter position');
		return false
	}else{
		$.ajax({
			url : base_url+'manage_website/update_our_technology_position',
			type: 'POST',
			dataType: 'html',
			data: {our_technology_id:our_technology_id,position_value:position_value},
			beforeSend: function() {
				$('#set_button_'+our_technology_id).html('.....');
			},
			success: function(data){
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Position successfully saved...',
						container : 'floating',
						timer : 3000
					});
				}else{
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'OOPS! Somthing went wrongs...',
						container : 'floating',
						timer : 3000
					});
				}
				$('#set_button_'+our_technology_id).html('<i class="fa fa-check"></i>  Set');
			}
		});
	}
}	
</script>