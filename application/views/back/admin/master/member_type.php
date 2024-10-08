<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_models');?></h1>
		<!-- <form action="<?php echo base_url();?>admin/master_manage/member_type_excel?c_n=<?php echo @$member_type; ?>" method="post">
			<input type="hidden" name="export_type" value="excel">
			<button class="btn btn-primary btn-labeled fa fa-file-pdf-o add_pro_btn pull-right custombutton">Excel</button>
		</form> -->
		<?php if($this->crud_model->admin_permission('member_type_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin//master_manage/member_type_add"><?php echo translate('create_member_type');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin//master_manage/member_type" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Model Name</label>
										<input type="text" name="c_n" value="<?php echo @$member_type; ?>" placeholder="Model Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<button class="reportbutton">Search</button>
										<?php if(@$member_type != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin//master_manage/member_type">Reset</a>
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
												<th><?php echo translate('member_type');?></th>
												<th><?php echo translate('status');?></th>
												<th ><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_product);
											if(!empty($all_member_type)){
												$i = $page_id+0;
												foreach($all_member_type as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['member_type_name']; ?></td>
												<td>
													<?php 
														if($row['member_type_status'] == 'active'){
															echo  '<input id="mas_'.$row['member_type_id'].'" class="sw1" type="checkbox" data-id="'.$row['member_type_id'].'" checked />';
														} else {
															echo '<input id="mas_'.$row['member_type_id'].'" class="sw1" type="checkbox" data-id="'.$row['member_type_id'].'" />';
														}
													?>
												</td>
												<?php if($this->crud_model->admin_permission('member_type_view') || $this->crud_model->admin_permission('member_type_status') || $this->crud_model->admin_permission('member_type_delete') || $this->crud_model->admin_permission('member_type_edit')){?>
													<td class="text-center">
														<?php if($this->crud_model->admin_permission('member_type_view')){ ?> 
															<?php if(@$member_type != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/member_type_view?c_n=<?php echo @$member_type; ?>&c_i=<?php echo $row['member_type_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/member_type_view?c_i=<?php echo $row['member_type_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php } ?> 
														<?php } ?> 
														<?php if($this->crud_model->admin_permission('member_type_edit')){ ?> 
															<?php if(@$member_type != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/member_type_edit?c_n=<?php echo @$member_type; ?>&c_i=<?php echo $row['member_type_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//master_manage/member_type_edit?c_i=<?php echo $row['member_type_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php } ?>
														<?php } ?>
														<?php if($this->crud_model->admin_permission('member_type_delete')){ ?> 
															<a onclick="delete_confirm('<?php echo $row['member_type_id']; ?>','<?php echo translate('really_want_to_delete_this_member_type?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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
	var module = 'master_manage/member_types';
	var list_cont_func = '';
	var dlt_cont_func = 'delete';
	var extra = 'master_manage_delete';
</script>