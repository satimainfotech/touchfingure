<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_user');?></h1>
		<?php if($this->crud_model->admin_permission('product_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin//user/user_add"><?php echo translate('create_user');?> </a>
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
										<label>Member Type</label>
										<select name="c_i" onchange="select_category(this.value)" class="demo-chosen-select" data-placeholder="Choose a category" id="category">
											<option value="">Choose one</option>
											<?php foreach($member_type_data as $member_type_row){ 
												if($c_row['category_id'] == $category){
													$selected = "selected='selected'";
												}else{
													$selected = "";
												}
											?>
												<option value="<?php echo $member_type_row['member_type_id']; ?>" <?php echo $selected; ?>><?php echo $member_type_row['member_type_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									
									
									
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
										<label>Name</label>
										<input type="text" name="name" value="<?php echo @$name; ?>" placeholder="Name">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
										<label>Mobile</label>
										<input type="text" name="mobile" value="<?php echo @$mobile; ?>" placeholder="Mobile">
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
												<th><?php echo translate('name');?></th>
												<th style="width:50px"><?php echo translate('mobile');?></th>
												<th class="minwidth50px"><?php echo translate('email');?></th>
												<th class="minwidth50px"><?php echo translate('member_type');?></th>
												<th class="minwidth50px"><?php echo translate('adharcard');?></th>
												<th class="minwidth50px"><?php echo translate('pancard');?></th>
												<th class="minwidth50px"><?php echo translate('pofile_image');?></th>
												<th class="minwidth50px"><?php echo translate('adharcard_image');?></th>
												<th class="minwidth50px"><?php echo translate('pancard_image');?></th>
												<th><?php echo translate('status');?></th>
												<th style="min-width: 150px;"><?php echo translate('options');?></th>
											</tr>
										</thead>
										<tbody>
										<?php
										
											if(!empty($all_user)){
												$i = $page_id+0;
												foreach($all_user as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['mobile']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['member_type_name']; ?></td>
												<td><?php echo $row['adharcard']; ?></td>
												<td><?php echo $row['pancard']; ?></td>
												<td>
												
													<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="<?php echo base_url(); ?>uploads/abdaily_profile_images/<?php echo $row['profile_image']; ?>"  />
												</td>
												<td>
												
													<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="<?php echo base_url(); ?>uploads/abdaily_adharcard_images/<?php echo $row['adharcard_image']; ?>"  />
												</td>
												<td>
												
													<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="<?php echo base_url(); ?>uploads/abdaily_pancard_images/<?php echo $row['pancard_image']; ?>"  />
												</td>
												
												<td>
													<?php 
														if($row['status'] == 'active'){
															echo  '<input id="prod_s_'.$row['id'].'" class="pro_status" type="checkbox" data-id="'.$row['id'].'" checked />';
														} else {
															echo '<input id="prod_s_'.$row['id'].'" class="pro_status" type="checkbox" data-id="'.$row['id'].'" />';
														}
													?>
												</td>
												<td class="text-right">
													<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/user_view?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/user_view?p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
													<?php } ?> 
													
													<?php if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/user_edit?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
													<?php }else{ ?>
														<a class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/user_edit?p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('edit'); ?></a>
													<?php } ?>
													<?php if($this->crud_model->admin_permission('product_delete')){ ?>
														<a onclick="delete_popup('<?php echo $row['id']; ?>','<?php echo translate('really_want_to_delete_this_user ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
													<?php } ?>
													
													<a target="blank" class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/idcard?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('Idcard'); ?></a>
												<a target="blank" class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/letter?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('Letter'); ?></a>
												<br><br>
												<a target="blank" class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/visitingcard?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('Vistingcard'); ?></a>
												<a target="blank" class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/congratulations?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('Congratulations'); ?></a>
													<a target="blank" class="btn btn-success btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" href="<?php echo base_url(); ?>admin//user/payment_receipt?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?>&p_i=<?php echo $row['id']; ?>&p_t=<?php echo $row['user_token']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('payment_receipt'); ?></a>
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
	var user_type = 'admin/abdaily';
	var module = 'user/users';
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