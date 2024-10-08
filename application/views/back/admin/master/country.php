<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_material');?></h1>
		<!-- <form action="<?php echo base_url();?>admin/master_manage/country_excel?c_n=<?php echo @$country; ?>" method="post">
			<input type="hidden" name="export_type" value="excel">
			<button class="btn btn-primary btn-labeled fa fa-file-pdf-o add_pro_btn pull-right custombutton">Excel</button>
		</form> -->
		<?php if($this->crud_model->admin_permission('country_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin//master_manage/country_add"><?php echo translate('create_country');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin//master_manage/country" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Material name</label>
										<input type="text" name="c_n" value="<?php echo @$country; ?>" placeholder="Material Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<button class="reportbutton">Search</button>
										<?php if(@$country != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin//master_manage/country">Reset</a>
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
												<th><?php echo translate('material');?></th>
												<th><?php echo translate('status');?></th>
												<th ><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_product);
											if(!empty($all_country)){
												$i = $page_id+0;
												foreach($all_country as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['country_name']; ?></td>
												<td>
													<?php 
														if($row['country_status'] == 'active'){
															echo  '<input id="mas_'.$row['country_id'].'" class="sw1" type="checkbox" data-id="'.$row['country_id'].'" checked />';
														} else {
															echo '<input id="mas_'.$row['country_id'].'" class="sw1" type="checkbox" data-id="'.$row['country_id'].'" />';
														}
													?>
												</td>
												<?php if($this->crud_model->admin_permission('country_view') || $this->crud_model->admin_permission('country_status') || $this->crud_model->admin_permission('country_delete') || $this->crud_model->admin_permission('country_edit')){?>
													<td class="text-center">
														<?php if($this->crud_model->admin_permission('country_view')){ ?> 
															<?php if(@$country != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/country_view?c_n=<?php echo @$country; ?>&c_i=<?php echo $row['country_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/country_view?c_i=<?php echo $row['country_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php } ?> 
														<?php } ?> 
														<?php if($this->crud_model->admin_permission('country_edit')){ ?> 
															<?php if(@$country != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/country_edit?c_n=<?php echo @$country; ?>&c_i=<?php echo $row['country_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/country_edit?c_i=<?php echo $row['country_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php } ?>
														<?php } ?>
														<?php if($this->crud_model->admin_permission('country_delete')){ ?> 
															<a onclick="delete_confirm('<?php echo $row['country_id']; ?>','<?php echo translate('really_want_to_delete_this_country?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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
	var module = 'master_manage/countrys';
	var list_cont_func = '';
	var dlt_cont_func = 'delete';
	var extra = 'master_manage_delete';
</script>