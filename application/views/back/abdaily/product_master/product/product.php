<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_product');?></h1>
		<?php if($this->crud_model->admin_permission('product_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/product/product_add"><?php echo translate('create_product');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/product" method="get">
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
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
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
										<label>Sub Category</label>
										<div id="sub_category_data">
											<select id="sub_category" name="s_c_i" placeholder="Select a category" class="demo-chosen-select" >
												<option value="">First select a Category</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
										<label>Brand</label>
										<select name="b_i" class="demo-chosen-select" data-placeholder="Choose a brand" id="brand">
											<option value="">Choose one</option>
											<?php foreach($brand_data as $b_row){ 
												if($b_row['brand_id'] == $brand){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $b_row['brand_id']; ?>" <?php echo $selected; ?>><?php echo $b_row['brand_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
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
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
										<label>Product Name</label>
										<input type="text" name="p_n" value="<?php echo @$product_name; ?>" placeholder="Product Name">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
										<button class="reportbutton">Search</button>
										<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/product">Reset</a>
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
												<th><?php echo translate('image');?></th>
												<th style="width:50px"><?php echo translate('ID');?></th>
												<th class="minwidth150px"><?php echo translate('name');?></th>
												<th class="minwidth150px"><?php echo translate('category');?></th>
												<th class="minwidth150px"><?php echo translate('sub_category');?></th>
												<th><?php echo translate('status');?></th>
												<th style="min-width: 150px;"><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo "<pre>"; print_r($all_product);
											if(!empty($all_product)){
												$i = $page_id+0;
												foreach($all_product as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td>
													<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>"  />
												</td>
												<td><?php echo $row['product_id']; ?></td>
												<td>
													<?php if($row['product_name'] == ''){
														echo '- - -';  
													}else{
														echo $row['product_name'];  
													} ?>
												</td>
												<td>
													<?php if($row['category_id'] == '' && $row['category_id'] == '0'){
														echo '- - -';  
													}else{
														if($row['category_id'] != '' && $row['category_id'] != '0'){ echo get_field_id_name('category','category_id','category_name',$row['category_id']); }else { echo '- - - N/A - - -'; }  
													} ?>
												</td>
												<td>
													<?php if($row['sub_category_id'] == '' && $row['sub_category_id'] == '0'){
														echo '- - -';  
													}else{
														if($row['sub_category_id'] != '' && $row['sub_category_id'] != '0'){ echo get_field_id_name('sub_category','sub_category_id','sub_category_name',$row['sub_category_id']); }else { echo '- - - N/A - - -'; }
													} ?>
												</td>
												<td>
													<?php 
														if($row['status'] == 'Active'){
															echo  '<input id="prod_s_'.$row['product_id'].'" class="pro_status" type="checkbox" data-id="'.$row['product_id'].'" checked />';
														} else {
															echo '<input id="prod_s_'.$row['product_id'].'" class="pro_status" type="checkbox" data-id="'.$row['product_id'].'" />';
														}
													?>
												</td>
												<td class="text-right">
													<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/product/product_view?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['product_id']; ?>&p_t=<?php echo $row['product_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/product/product_view?p_i=<?php echo $row['product_id']; ?>&p_t=<?php echo $row['product_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php } ?> 
													
													<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/product/product_edit?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['product_id']; ?>&p_t=<?php echo $row['product_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/product/product_edit?p_i=<?php echo $row['product_id']; ?>&p_t=<?php echo $row['product_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
													<?php } ?>
													<?php if($this->crud_model->admin_permission('product_delete')){ ?>
														<a onclick="delete_popup('<?php echo $row['product_id']; ?>','<?php echo translate('really_wanf_to_delete_this_product ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
	var module = 'product/products';
	var list_cont_func = '';
	var delete_function = 'delete';
	var extra = 'product_delete';
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	var selected_category = '<?php echo @$category; ?>';
	var selected_sub_category = '<?php echo @$sub_category; ?>';
	var selected_brand = '<?php echo @$brand; ?>';
	var selected_our_range = '<?php echo @$our_range; ?>';
	$(document).ready(function() {
        set_select();
		if(selected_category != ''){
			select_category(selected_category);
			$("#category").val(selected_category).trigger("chosen:updated");
		}
		if(selected_brand != ''){
			$("#brand").val(selected_brand).trigger("chosen:updated");
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
				url : base_url+'product/get_search_sub_category_data',
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