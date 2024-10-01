<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('contact_enquires');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/contact_enquire" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>Phone Number</label>
										<input type="text" name="p_n" value="<?php echo @$phone; ?>" placeholder="Phone Number">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>From date</label>
										<input type="date" name="f_d" value="<?php echo @$from_date; ?>" placeholder="From date">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>To date</label>
										<input type="date" name="t_d" value="<?php echo @$to_date; ?>" placeholder="To date">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<button class="reportbutton">Search</button>
										<?php if(@$phone != '' || @$from_date != '' || @$to_date != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/contact_enquire">Reset</a>
										<?php } ?>
									</div>
								</form>
							</div>
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th style="width:4px"><?php echo translate('Sr No.');?></th>
												<th style="width:50px"><?php echo translate('name');?></th>
												<th class="minwidth150px"><?php echo translate('email');?></th>
												<th class="minwidth150px"><?php echo translate('city');?></th>
												<th class="minwidth150px"><?php echo translate('phone');?></th>
												<th class="minwidth150px"><?php echo translate('date');?></th>
												<th style="min-width: 150px;"><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_contact);
											if(!empty($all_contact_enquire)){
												$i = $page_id+0;
												foreach($all_contact_enquire as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>
													<?php if($row['contact_enquire_name'] == ''){
														echo '- - -';  
													}else{
														echo $row['contact_enquire_name'];  
													} ?>
												</td>
												<td>
													<?php if($row['contact_enquire_email'] != ''){ 
														echo $row['contact_enquire_email']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['contact_enquire_city'] != ''){ 
														echo $row['contact_enquire_city']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['contact_enquire_phone'] != ''){ 
														echo $row['contact_enquire_phone']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['contact_enquire_created_date'] != ''){ 
														echo get_orignal_datetime($row['contact_enquire_created_date']); 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td class="text-right">
													<?php if(@$phone != '' || @$from_date != '' || @$to_date != ''){?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/contact_enquire/contact_enquire_view?ce_t=<?php echo @$row['contact_enquire_token']; ?>&ce_i=<?php echo @$row['contact_enquire_id']; ?>&p_n=<?php echo @$phone; ?>&f_d=<?php echo $from_date; ?>&t_d=<?php echo $to_date; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/contact_enquire/contact_enquire_view?ce_t=<?php echo @$row['contact_enquire_token']; ?>&ce_i=<?php echo @$row['contact_enquire_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php } ?> 
													<?php if($this->crud_model->admin_permission('contact_delete')){ ?>
														<a onclick="delete_popup('<?php echo $row['contact_enquire_id']; ?>','<?php echo translate('really_wanf_to_delete_this_contact_enquire ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
	var module = 'contact_enquire/contact_enquires';
	var list_cont_func = '';
	var delete_function = 'delete';
	var extra = 'contact_delete';
</script>