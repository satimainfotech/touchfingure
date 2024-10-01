<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_faq');?></h1>
		<?php if($this->crud_model->admin_permission('faq_add')){?>
			<?php if(@$category != ''){?>
				<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/abdaily/manage_website/faq_add?c_i=<?php echo @$category; ?>"><?php echo translate('create_faq');?> </a>
			<?php }else{ ?>
				<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/abdaily/manage_website/faq_add"><?php echo translate('create_faq');?> </a>
			<?php } ?>
			
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
										<th><?php echo translate('title');?></th>
										<th><?php echo translate('status');?></th>
										<th><?php echo translate('set_show_on_home');?></th>
										<th><?php echo translate('position');?></th>
										<?php if($this->crud_model->admin_permission('faq_view') || $this->crud_model->admin_permission('faq_status')|| $this->crud_model->admin_permission('faq_delete')|| $this->crud_model->admin_permission('faq_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_faq)){
									$i = $page_id+1;
									foreach($all_faq as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									<td>
										<?php echo $row['faq_name']; ?>
									</td>
									<td>
										<input id="slide_<?php echo $row['faq_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['faq_id']; ?>" <?php if($row['faq_status']=='yes'){ echo 'checked'; } ?> />
									</td>
									<td>
										<input id="slides_<?php echo $row['faq_id']; ?>" class="slides" type="checkbox" data-id="<?php echo $row['faq_id']; ?>" <?php if($row['faq_show_on_home']=='yes'){ echo 'checked'; } ?> />
									</td>
									<td class="table_input_field">
										<input type="text" name="p_faq_<?php echo $row['faq_id']; ?>" id="p_faq_<?php echo $row['faq_id']; ?>" value="<?php if($row['position'] != ''){ echo $row['position']; }else{ echo '0'; }?>"><span class="set_button" id="set_button_<?php echo $row['faq_id']; ?>" onclick="set_faq_position('<?php echo $row['faq_id']; ?>');"><i class="fa fa-check"></i>  Set</span>
									</td>
									<?php if($this->crud_model->admin_permission('faq_view') || $this->crud_model->admin_permission('faq_status')|| $this->crud_model->admin_permission('faq_delete')|| $this->crud_model->admin_permission('faq_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('faq_view')){ ?>
												<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/faq_view?f_t=<?php echo $row['faq_token']; ?>&f_i=<?php echo $row['faq_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('faq_edit')){ ?>
												<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/faq_edit?f_t=<?php echo $row['faq_token']; ?>&f_i=<?php echo $row['faq_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="Edit" data-container="body"><?php echo translate('edit');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('faq_delete')){ ?>
												<a onclick="delete_popup('<?php echo $row['faq_id']; ?>','<?php echo translate('really_wanf_to_delete_this_faq ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
var user_type = 'admin/abdaily';
var module = 'manage_website/faqs';
var delete_function = 'delete';

function set_select(){
	$('.demo-chosen-select').chosen();
	$('.demo-cs-multiselect').chosen({width:'100%'});
}

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
function set_faq_position(faq_id){
	var position_value = $('#p_faq_'+faq_id).val();
	var base_url = $('#base_url').val();
	if(position_value == ''){
		alert('Enter position');
		return false
	}else{
		$.ajax({
			url : base_url+'manage_website/update_faq_position',
			type: 'POST',
			dataType: 'html',
			data: {faq_id:faq_id,position_value:position_value},
			beforeSend: function() {
				$('#set_button_'+faq_id).html('.....');
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
				$('#set_button_'+faq_id).html('<i class="fa fa-check"></i>  Set');
			}
		});
	}
}	
</script>