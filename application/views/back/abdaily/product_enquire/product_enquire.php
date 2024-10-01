<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('product_enquires');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/product_enquire" method="get">
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>Category</label>
										<select name="c_i" onchange="select_category(this.value)" class="demo-chosen-select" data-placeholder="Choose a category" id="category">
											<option value="">Choose one</option>
											<?php foreach($category_data as $c_row){ 
												if($c_row['category_id'] == $category){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $c_row['category_id']; ?>" <?php echo $selected; ?>><?php echo $c_row['category_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>Sub Category</label>
										<div id="sub_category_data">
											<select id="sub_category" name="s_c_i" placeholder="Select a category" class="demo-chosen-select" >
												<option value="">First select a Category</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>Product Name</label>
										<input type="text" name="p_n" value="<?php echo @$product_name; ?>" placeholder="Product Name">
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
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/product_enquire">Reset</a>
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
												<th style="width:50px"><?php echo translate('product_name');?></th>
												<th class="minwidth150px"><?php echo translate('category');?></th>
												<th class="minwidth150px"><?php echo translate('sub_category');?></th>
												<th class="minwidth150px"><?php echo translate('our_range');?></th>
												<th class="minwidth150px"><?php echo translate('date');?></th>
												<th><?php echo translate('status');?></th>
												<th style="min-width: 150px;"><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_product);
											if(!empty($all_product_enquire)){
												$i = $page_id+0;
												foreach($all_product_enquire as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>
													<?php if($row['product_name'] == ''){
														echo '- - -';  
													}else{
														echo $row['product_name'];  
													} ?>
												</td>
												<td>
													<?php if($row['category_name'] != ''){ 
														echo $row['category_name']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['sub_category_name'] != ''){ 
														echo $row['sub_category_name']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['our_range_name'] != ''){ 
														echo $row['our_range_name']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												<td>
													<?php if($row['enquire_date'] != ''){ 
														echo get_orignal_datetime($row['enquire_date']); 
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
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/product_enquire/product_enquire_view?pe_t=<?php echo @$row['inq_token']; ?>&pe_i=<?php echo @$row['inq_id']; ?>&c_i=<?php echo @$category; ?>&sc_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$product_name; ?>&f_d=<?php echo $from_date; ?>&t_d=<?php echo $to_date; ?>&or_i=<?php echo $our_range; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/product_enquire/product_enquire_view?pe_t=<?php echo @$row['inq_token']; ?>&pe_i=<?php echo @$row['inq_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php } ?> 
													<?php if($this->crud_model->admin_permission('product_delete')){ ?>
														<a onclick="delete_popup('<?php echo $row['inq_id']; ?>','<?php echo translate('really_wanf_to_delete_this_product_enquire ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
	var module = 'product_enquire/product_enquires';
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
				url : base_url+'product_enquire/get_search_sub_category_data',
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