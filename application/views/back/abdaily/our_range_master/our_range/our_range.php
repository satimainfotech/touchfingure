<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_our_range');?></h1>
		<?php if($this->crud_model->admin_permission('our_range_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/our_range/our_range_add"><?php echo translate('create_our_range');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th style="width:4px"><?php echo translate('Sr No.');?></th>
												<th><?php echo translate('image');?></th>
												<th style="width:50px"><?php echo translate('ID');?></th>
												<th class="minwidth150px"><?php echo translate('name');?></th>
												<th><?php echo translate('status');?></th>
												<th style="min-width: 150px;"><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_our_range);
											if(!empty($all_our_range)){
												$i = $page_id+0;
												foreach($all_our_range as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>
													<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_main_image']; ?>"  />
												</td>
												<td><?php echo $row['our_range_id']; ?></td>
												<td>
													<?php if($row['our_range_name'] == ''){
														echo '- - -';  
													}else{
														echo $row['our_range_name'];  
													} ?>
												</td>
												<td>
													<?php 
														if($row['our_range_status'] == 'Active'){
															echo  '<input id="prod_s_'.$row['our_range_id'].'" class="pro_status" type="checkbox" data-id="'.$row['our_range_id'].'" checked />';
														} else {
															echo '<input id="prod_s_'.$row['our_range_id'].'" class="pro_status" type="checkbox" data-id="'.$row['our_range_id'].'" />';
														}
													?>
												</td>
												<td class="text-right">
													<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/our_range/our_range_view?or_i=<?php echo $row['our_range_id']; ?>&or_t=<?php echo $row['our_range_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													
													<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/our_range/our_range_edit?or_i=<?php echo $row['our_range_id']; ?>&or_t=<?php echo $row['our_range_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
													<?php if($this->crud_model->admin_permission('our_range_delete')){ ?>
														<a onclick="delete_popup('<?php echo $row['our_range_id']; ?>','<?php echo translate('really_wanf_to_delete_this_our_range ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
													<?php } ?>
												</td>
											</tr>
										<?php } }else{ ?>
											<tr style="text-align:center;">
												<td colspan="9">Data Not Found....</td>
											</tr>	
										<?php } ?>
										</tbody>
									</table>
								</div>  
							</div>  
						</div>  
						<div class="custom_pagination">
							<?php echo $links; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<span id="prod" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'our_range/our_ranges';
	var list_cont_func = '';
	var delete_function = 'delete';
	var extra = 'our_range_delete';
	function set_switchery(){
		$(".pro_status").each(function(){
			new Switchery(document.getElementById('prod_s_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
			var changeCheckbox = document.querySelector('#prod_s_'+$(this).data('id'));
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
	}
</script>