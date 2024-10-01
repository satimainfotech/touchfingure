<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('social_media');?></h1>
		<?php if($this->crud_model->admin_permission('social_media_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/abdaily/manage_website/social_media_add"><?php echo translate('add_a_new_social_media');?> </a>
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
										<th><?php echo translate('Sr.no');?></th>
										<th><?php echo translate('name');?></th>
										<th><?php echo translate('icon');?></th>
										<th><?php echo translate('link');?></th>
										<th><?php echo translate('status');?></th>
										<th><?php echo translate('position');?></th>
										<?php if($this->crud_model->admin_permission('social_media_view') || $this->crud_model->admin_permission('social_media_status')|| $this->crud_model->admin_permission('social_media_delete')|| $this->crud_model->admin_permission('social_media_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_social_media)){
									$i = @$page_id + 0;
									foreach($all_social_media as $row){
										$i++;
								?>                
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td>
										<span id="social_media_wrap" class=" show_iin_image" style="width: 50px;float:left; border:1px solid #ddd;border-radius:5px;padding:5px">
											<?php
											if($row['icon'] != ''){
												if(file_exists('uploads/web_social_icon/'.$row['icon'])){
											?>
												<img src="<?php echo base_url(); ?>uploads/web_social_icon/<?php echo $row['icon']; ?>" width="100%" id="social_media_blah" />  
											<?php
												} else {
											?>
												<img src="<?php echo base_url(); ?>uploads/web_social_icon/default.png" width="100%" id="social_media_blah" />
											<?php
												}
											}else{?>
												<img src="<?php echo base_url(); ?>uploads/web_social_icon/default.png" width="100%" id="social_media_blah" />
											<?php }
											?> 
										</span>
									</td>
									<td><?php echo $row['link']; ?></td>
									<td>
									<?php 
										if($row['status'] == 'Active'){
											echo '<input id="social_media_'.$row['w_s_id'].'" class="sw1" type="checkbox" data-id="'.$row['w_s_id'].'" checked />';
										} else {
											echo '<input id="social_media_'.$row['w_s_id'].'" class="sw1" type="checkbox" data-id="'.$row['w_s_id'].'" />';
										}
										?>
									</td>
									<td class="table_input_field">
										<input type="text" name="p_w_s_<?php echo $row['w_s_id']; ?>" id="p_w_s_<?php echo $row['w_s_id']; ?>" value="<?php if($row['position'] != ''){ echo $row['position']; }else{ echo '0'; }?>"><span class="set_button" id="set_button_<?php echo $row['w_s_id']; ?>" onclick="set_achievements_position('<?php echo $row['w_s_id']; ?>');"><i class="fa fa-check"></i>  Set</span>
									</td>
									<?php if($this->crud_model->admin_permission('social_media_view') || $this->crud_model->admin_permission('social_media_delete') || $this->crud_model->admin_permission('social_media_edit')){ ?>
										<td class="text-center">
											<?php if($this->crud_model->admin_permission('social_media_edit')){ ?>
												<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/social_media_edit?s_t=<?php echo $row['w_s_token']; ?>&s_i=<?php echo $row['w_s_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?>
													</a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('social_media_delete')){ ?> 
												<a onclick="delete_popup('<?php echo $row['w_s_id']; ?>','<?php echo translate('really_want_to_delete_this_social_media ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?>
												</a>
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
<span id="social_media" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin/abdaily';
	var module = 'manage_website/social_medias';
	var delete_function = 'delete';
</script>
<script>
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function other(){
	    set_select();
    }
	$(document).ready(function() {
        set_select();
	});
	
	$( document ).ready(function() {
		$(".sw1").each(function(){
			new Switchery(document.getElementById('social_media_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
			var changeCheckbox = document.querySelector('#social_media_'+$(this).data('id'));
			changeCheckbox.onchange = function() {
			ajax_load(base_url+''+user_type+'/'+module+'/status_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
			if(changeCheckbox.checked == true){
				var trans_msg = 'Social Media successfully avtivated';
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
			} else {
				var trans_msg = 'Social Media successfully De-avtivated';
				$.activeitNoty({
					type : 'danger',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
				
			  }
			};
		});
	});
	function set_achievements_position(w_s_id){
		var position_value = $('#p_w_s_'+w_s_id).val();
		var base_url = $('#base_url').val();
		if(position_value == ''){
			alert('Enter position');
			return false
		}else{
			$.ajax({
				url : base_url+'manage_website/update_web_social_media_position',
				type: 'POST',
				dataType: 'html',
				data: {w_s_id:w_s_id,position_value:position_value},
				beforeSend: function() {
					$('#set_button_'+w_s_id).html('.....');
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
					$('#set_button_'+w_s_id).html('<i class="fa fa-check"></i>  Set');
				}
			});
		}
	}
</script>