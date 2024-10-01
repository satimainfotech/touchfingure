<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('event_enquires');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/event_enquire" method="get">
									
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>Event Name</label>
										<input type="text" name="p_n" value="<?php echo @$product_name; ?>" placeholder="Event Name">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>From date</label>
										<input type="date" name="f_d" value="<?php echo @$from_date; ?>" placeholder="From date">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>To date</label>
										<input type="date" name="t_d" value="<?php echo @$to_date; ?>" placeholder="To date">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height" style="display:none;">
										<label>Our Range</label>
										<select name="or_i" class="demo-chosen-select" data-placeholder="Choose a our range" id="our_range">
											<option value="">Choose one</option>
											<?php foreach($our_range_data as $or_row){ 
												if($or_row['our_range_id'] == $our_range){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $or_row['our_range_id']; ?>" <?php echo $selected; ?>><?php echo $or_row['our_range_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<button class="reportbutton">Search</button>
										<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$from_date != '' || @$to_date != '' || @$our_range != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/event_enquire">Reset</a>
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
												<th style="width:50px"><?php echo translate('event_name');?></th>
												<th class="minwidth150px"><?php echo translate('city');?></th>
												<th class="minwidth150px"><?php echo translate('name');?></th>
												<th class="minwidth150px"><?php echo translate('email');?></th>
												<th class="minwidth150px"><?php echo translate('phone');?></th>
												<th class="minwidth150px"><?php echo translate('date');?></th>
												<th><?php echo translate('status');?></th>
												<th style="min-width: 150px;"><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_product);
											if(!empty($all_event_enquire)){
												$i = $page_id+0;
												foreach($all_event_enquire as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>
													<?php if($row['event_name'] == ''){
														echo '- - -';  
													}else{
														echo $row['event_name'];  
													} ?>
												</td>
											
												<td>
													<?php if($row['city_name'] != ''){ 
														echo $row['city_name']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['name'] != ''){ 
														echo $row['name']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['email'] != ''){ 
														echo $row['email']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['phone'] != ''){ 
														echo $row['phone']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['created_date'] != ''){ 
														echo $row['created_date']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php 
														if($row['status'] == 'Active'){
															echo  $row['status'];
														} else {
															echo '- - - N/A - - -'; 
														}
													?>
												</td>
												<td class="text-right">
													<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$from_date != '' || @$to_date != '' || @$our_range != ''){?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/event_enquire/event_enquire_view?pe_t=<?php echo @$row['inq_token']; ?>&pe_i=<?php echo @$row['inq_id']; ?>&c_i=<?php echo @$category; ?>&sc_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$product_name; ?>&f_d=<?php echo $from_date; ?>&t_d=<?php echo $to_date; ?>&or_i=<?php echo $our_range; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/event_enquire/event_enquire_view?pe_t=<?php echo @$row['inq_token']; ?>&pe_i=<?php echo @$row['inq_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php } ?> 
													<?php /*if($this->crud_model->admin_permission('product_delete')){ ?>
														<a onclick="delete_popup('<?php echo $row['inq_id']; ?>','<?php echo translate('really_want_to_delete_this_event_enquire ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
													<?php } */?>
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
	var module = 'event_enquire/event_enquires';
	var list_cont_func = '';
	var delete_function = 'delete';
	var extra = 'product_delete';
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	var selected_category = '<?php echo @$category; ?>';
	var selected_sub_category = '<?php echo @$sub_category; ?>';
	var selected_our_range = '<?php echo @$our_range; ?>';
	$(document).ready(function() {
        set_select();
		if(selected_category != ''){
			select_category(selected_category);
			$("#category").val(selected_category).trigger("chosen:updated");
		}
		if(selected_our_range != ''){
			$("#our_range").val(selected_our_range).trigger("chosen:updated");
		}
	});
	function select_category(category){
		var base_url = $('#base_url').val();
		if(category == ''){
			
		}else{
			$.ajax({
				url : base_url+'event_enquire/get_search_sub_category_data',
				type: 'POST',
				dataType: 'html',
				data: {category:category},
				success: function(data){
					if(data != ''){
						$('#sub_category_data').html(data);
						if($.trim(selected_sub_category) != ''){
							$("#sub_category").val(selected_sub_category).trigger("chosen:updated");
						}
					}
				}
			});
		}
	}
</script>