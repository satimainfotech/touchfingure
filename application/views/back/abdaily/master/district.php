<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_district');?></h1>
		<!-- <form action="<?php echo base_url();?>mind1992gameadmin/master_manage/district_excel?c_i=<?php echo @$country; ?>&s_i=<?php echo $state; ?>&c_n=<?php echo $district; ?>" method="post">
			<input type="hidden" name="export_type" value="excel">
			<button class="btn btn-primary btn-labeled fa fa-file-pdf-o add_pro_btn pull-right custombutton">Excel</button>
		</form> -->
		<?php if($this->crud_model->admin_permission('district_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_add"><?php echo translate('create_district');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/abdaily/master_manage/district" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Country</label>
										<select name="c_i" class="demo-chosen-select"   data-placeholder="Choose a district" id="division">
											<option value="">Choose one</option>
											<?php foreach($division_data as $d_row){ 
												if($d_row['division_id'] == $division){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $d_row['division_id']; ?>" <?php echo $selected; ?>><?php echo $d_row['division_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>District name</label>
										<input type="text" name="d_n" value="<?php echo @$district; ?>" placeholder="district Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<button class="reportbutton">Search</button>
										<?php if(@$division != '' || @$district != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district">Reset</a>
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
												<th><?php echo translate('district');?></th>
												<th><?php echo translate('division');?></th>												
												<th><?php echo translate('status');?></th>
												<th ><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
									
											if(!empty($all_district)){
												$i = $page_id+0;
												foreach($all_district as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['district_name']; ?></td>
												<td><?php echo $row['division_name']; ?></td>												
												<td>
													<?php 
														if($row['district_status'] == 'active'){
															echo  '<input id="mas_'.$row['district_id'].'" class="sw1" type="checkbox" data-id="'.$row['district_id'].'" checked />';
														} else {
															echo '<input id="mas_'.$row['district_id'].'" class="sw1" type="checkbox" data-id="'.$row['district_id'].'" />';
														}
													?>
												</td>
												<?php if($this->crud_model->admin_permission('district_view') || $this->crud_model->admin_permission('district_status') || $this->crud_model->admin_permission('district_delete') || $this->crud_model->admin_permission('district_edit')){?>
													<td class="text-center">
														<?php if($this->crud_model->admin_permission('district_view')){ ?> 
															<?php if(@$country != '' || @$state != '' || @$district != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_view?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&d_n=<?php echo @$district; ?>&di_i=<?php echo $row['district_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_view?di_i=<?php echo $row['district_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php } ?> 
														<?php } ?> 
														<?php if($this->crud_model->admin_permission('district_edit')){ ?> 
															<?php if(@$country != '' || @$state != '' || @$district != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_edit?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&d_n=<?php echo @$district; ?>&di_i=<?php echo $row['district_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_edit?di_i=<?php echo $row['district_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php } ?>
														<?php } ?>
														<?php if($this->crud_model->admin_permission('district_delete')){ ?> 
															<a onclick="delete_confirm('<?php echo $row['district_id']; ?>','<?php echo translate('really_want_to_delete_this_district?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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
	var user_type = 'admin/abdaily';
	var module = 'master_manage/districts';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
	$(document).ready(function() {
        set_select();		
	});
</script>