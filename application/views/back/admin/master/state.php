<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_state');?></h1>
		<!-- <form action="<?php echo base_url();?>admin/master_manage/state_excel?c_i=<?php echo @$country; ?>&s_n=<?php echo $state; ?>" method="post">
			<input type="hidden" name="export_type" value="excel">
			<button class="btn btn-primary btn-labeled fa fa-file-pdf-o add_pro_btn pull-right custombutton">Excel</button>
		</form> -->
		<?php if($this->crud_model->admin_permission('state_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin//master_manage/state_add"><?php echo translate('create_state');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin//master_manage/state" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Country</label>
										<select name="c_i" class="demo-chosen-select" data-placeholder="Choose a Country" id="country">
											<option value="">Choose one</option>
											<?php foreach($country_data as $c_row){ 
												if($c_row['country_id'] == $country){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $c_row['country_id']; ?>" <?php echo $selected; ?>><?php echo $c_row['country_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>State name</label>
										<input type="text" name="s_n" value="<?php echo @$state; ?>" placeholder="State Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<button class="reportbutton">Search</button>
										<?php if(@$country != '' || @$state != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin//master_manage/state">Reset</a>
										<?php } ?>
									</div>
								</form>
							</div>
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th><?php echo translate('Sr No.');?></th>
												<th><?php echo translate('state');?></th>
												<th><?php echo translate('country');?></th>
												<th><?php echo translate('status');?></th>
												<th ><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										
											if(!empty($all_state)){
												$i = $page_id+0;
												foreach($all_state as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['state_name']; ?></td>
												<td><?php echo $row['country_name']; ?></td>
												<td>
													<?php 
														if($row['state_status'] == 'active'){
															echo  '<input id="mas_'.$row['state_id'].'" class="sw1" type="checkbox" data-id="'.$row['state_id'].'" checked />';
														} else {
															echo '<input id="mas_'.$row['state_id'].'" class="sw1" type="checkbox" data-id="'.$row['state_id'].'" />';
														}
													?>
												</td>
												<?php if($this->crud_model->admin_permission('state_view') || $this->crud_model->admin_permission('state_status') || $this->crud_model->admin_permission('state_delete') || $this->crud_model->admin_permission('state_edit')){?>
													<td class="text-center">
														<?php if($this->crud_model->admin_permission('state_view')){ ?> 
															<?php if(@$country != '' || @$state != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/state_view?c_i=<?php echo @$country; ?>&s_n=<?php echo @$state; ?>&s_i=<?php echo $row['state_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/state_view?s_i=<?php echo $row['state_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php } ?> 
														<?php } ?> 
														<?php if($this->crud_model->admin_permission('state_edit')){ ?> 
															<?php if(@$country != '' || @$state != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/state_edit?c_i=<?php echo @$country; ?>&s_n=<?php echo @$state; ?>&s_i=<?php echo $row['state_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/state_edit?s_i=<?php echo $row['state_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php } ?>
														<?php } ?>
														<?php if($this->crud_model->admin_permission('state_delete')){ ?> 
															<a onclick="delete_confirm('<?php echo $row['state_id']; ?>','<?php echo translate('really_want_to_delete_this_state?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
																data-original-title="Delete" data-container="body"><?php echo translate('delete');?>
															</a>
														<?php } ?>
													</td>
												<?php } ?>
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
<span id="master" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'master_manage/states';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	var extra = 'master_manage_delete';
	
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	var selected_country = '<?php echo @$country; ?>';
	$(document).ready(function() {
        set_select();
		if(selected_country != ''){
			$("#country").val(selected_country).trigger("chosen:updated");
		}
	});
</script>