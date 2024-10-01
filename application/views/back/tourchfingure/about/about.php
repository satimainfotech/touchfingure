<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('about');?></h1>
		<?php if($this->crud_model->admin_permission('about_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/about/add"><?php echo translate('add_a_new_about');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th><?php echo translate('Sr.no');?></th>
												<th><?php echo translate('about_title');?></th>
												<th><?php echo translate('status');?></th>
												<?php if($this->crud_model->admin_permission('about_view') || $this->crud_model->admin_permission('about_status')|| $this->crud_model->admin_permission('about_delete')){?>
													<th class="text-right"><?php echo translate('options');?></th>
												<?php } ?>
											</tr>
										</thead>				
										<tbody >
										<?php
										if(!empty($all_about)){
											$i = @$page_id + 0;
											foreach($all_about as $row){
												$i++;
										?>                
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['about_title']; ?></td>
											<td>
											<?php 
												if($row['about_status'] == 'Active'){
													echo '<input id="chart_'.$row['about_id'].'" class="sw2" type="checkbox" data-id="'.$row['about_id'].'" checked />';
												} else {
													echo '<input id="chart_'.$row['about_id'].'" class="sw2" type="checkbox" data-id="'.$row['about_id'].'" />';
												}
												?>
											</td>
											<?php if($this->crud_model->admin_permission('about_view') || $this->crud_model->admin_permission('about_delete') || $this->crud_model->admin_permission('about_edit')){ ?>
												<td class="text-center">
													<?php if($this->crud_model->admin_permission('about_view')){ ?>
														<a href="<?php echo base_url(); ?>admin/about/view?p_t=<?php echo $row['about_token']; ?>&p_i=<?php echo $row['about_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
													<?php } ?>
													<?php if($this->crud_model->admin_permission('about_edit')){?>
															<a href="<?php echo base_url(); ?>admin/about/edit?p_t=<?php echo $row['about_token']; ?>&p_i=<?php echo $row['about_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
													<?php } ?> 
													<?php if($this->crud_model->admin_permission('about_delete')){ ?> 
														<a onclick="delete_popup('<?php echo $row['about_id']; ?>','<?php echo translate('really_want_to_delete_this_about ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?>
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
							</div>
						</div>
						<?php echo $links; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="about" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'about/abouts';
	var delete_function = 'delete';
</script>
<script>
    function other_forms(){}
	
	$( document ).ready(function() {
		$(".sw2").each(function(){
			new Switchery(document.getElementById('chart_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
			var changeCheckbox = document.querySelector('#chart_'+$(this).data('id'));
			changeCheckbox.onchange = function() {
			ajax_load(base_url+''+user_type+'/'+module+'/status_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
			if(changeCheckbox.checked == true){
				var trans_msg = 'About successfully avtivated';
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
			} else {
				var trans_msg = 'About successfully De-avtivated';
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
</script>