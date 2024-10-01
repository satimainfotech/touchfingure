<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_gram_panchayat');?></h1>
		
		<?php if($this->crud_model->admin_permission('gram_panchayat_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat_add"><?php echo translate('create_gram_panchayat');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Taluka M</label>
										<select name="c_i" class="demo-chosen-select" onchange="select_country(this.value)"  data-placeholder="Choose a country" id="country">
											<option value="">Choose one</option>
											<?php foreach($taluka_data as $t_row){ 
												if($t_row['taluka_id'] == $taluka_m){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $t_row['taluka_id']; ?>" <?php echo $selected; ?>><?php echo $t_row['taluka_m_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Gram Panchayat name</label>
										<input type="text" name="a_n" value="<?php echo @$gram_panchayat; ?>" placeholder="gram_panchayat Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<button class="reportbutton">Search</button>
										<?php if( @$taluka_m != '' || @$gram_panchayat != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat">Reset</a>
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
												<th><?php echo translate('gram_panchayat');?></th>
												<th><?php echo translate('taluka_m');?></th>												
												<th><?php echo translate('status');?></th>
												<th ><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										
											if(!empty($all_gram_panchayat)){
												$i = $page_id+0;
												foreach($all_gram_panchayat as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['gram_panchayat_name']; ?></td>
												<td><?php echo $row['taluka_m_name']; ?></td>
												<td>
													<?php 
														if($row['gram_panchayat_status'] == 'active'){
															echo  '<input id="mas_'.$row['gram_panchayat_id'].'" class="sw1" type="checkbox" data-id="'.$row['gram_panchayat_id'].'" checked />';
														} else {
															echo '<input id="mas_'.$row['gram_panchayat_id'].'" class="sw1" type="checkbox" data-id="'.$row['gram_panchayat_id'].'" />';
														}
													?>
												</td>
												<?php if($this->crud_model->admin_permission('gram_panchayat_view') || $this->crud_model->admin_permission('gram_panchayat_status') || $this->crud_model->admin_permission('gram_panchayat_delete') || $this->crud_model->admin_permission('gram_panchayat_edit')){?>
													<td class="text-center">
														<?php if($this->crud_model->admin_permission('gram_panchayat_view')){ ?> 
															<?php if(@$country != '' || @$state != '' || @$district != '' || @$city != '' || @$gram_panchayat != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat_view?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&d_i=<?php echo @$district; ?>&ct_i=<?php echo @$city; ?>&a_n=<?php echo @$gram_panchayat; ?>&a_i=<?php echo $row['gram_panchayat_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat_view?a_i=<?php echo $row['gram_panchayat_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
															<?php } ?> 
														<?php } ?> 
														<?php if($this->crud_model->admin_permission('gram_panchayat_edit')){ ?> 
															<?php if(@$country != '' || @$state != '' || @$district != '' || @$city != '' || @$gram_panchayat != ''){?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat_edit?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&d_i=<?php echo @$district; ?>&ct_i=<?php echo @$city; ?>&a_n=<?php echo @$gram_panchayat; ?>&a_i=<?php echo $row['gram_panchayat_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php }else{ ?>
																<a class="btn btn-success btn-xs btn-labeled fa fa-pencil" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat_edit?a_i=<?php echo $row['gram_panchayat_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
															<?php } ?>
														<?php } ?>
														<?php if($this->crud_model->admin_permission('gram_panchayat_delete')){ ?> 
															<a onclick="delete_confirm('<?php echo $row['gram_panchayat_id']; ?>','<?php echo translate('really_want_to_delete_this_gram_panchayat?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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
	var module = 'master_manage/gram_panchayats';
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